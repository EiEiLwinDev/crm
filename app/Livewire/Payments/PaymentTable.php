<?php

namespace App\Livewire\Payments;

use App\Models\Application;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PaymentTable extends DataTableComponent
{
    protected $model = Payment::class;

    public $user;
    public $application;
    public ?int $perPage = 5;

    public function mount($user)
    {
        $this->user = $user;

        $this->application = $this->user->customer->applications->firstWhere('type', 'new_customer');
    }

    #[On('updatePayment')]
    public function builder(): Builder
    {
        return Payment::query()->select('payments.*')
            ->where('application_id', $this->application->id)
            ->with('application');

    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setPaginationEnabled()
         ->setPerPageAccepted([5])
         ->setPerPage(5)
         ->setPerPageVisibilityEnabled(false);
        
    }

    public function filters(): array
    {
        return [ 
            DateFilter::make('Payment Date','payment_date')
            ->config([
                'min' => '2020-01-01',
                'max' => Carbon::now()->format('Y-m-d'),
            ])
             ->setWireLive()
            ->filter(function(Builder $builder, string $value) {
                 $builder->where('payment_date', $value);
            }),
            SelectFilter::make('Payment Type', 'payment_type')
            ->options([
                '' => 'All',
                'bank' => 'Bank',
                'cash' => 'Cash',
            ])->filter(function(Builder $builder, string $value) {
                $builder->where('payment_type', $value);
            }),
        ];
    }

    public function columns(): array
    {
        return [   
            Column::make("Amount", "amount")
                ->sortable()->searchable(),
            Column::make("Payment Type", "payment_type")->format(function ($value) {
                $color = match (strtolower($value)) {
                    'bank' => 'bg-blue-100 text-blue-800',
                    'cash' => 'bg-green-100 text-green-800'
                };

                return '<span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium ' . $color . '">'
                    . ucfirst($value) .
                    '</span>';
            })
            ->html()
            ->sortable()
            ->searchable(), 
            DateColumn::make("Payment Date", 'payment_date') 
            ->outputFormat('d-M-Y')->sortable()
            ->emptyValue('-')->searchable(),
            Column::make("Evidence", "evidence")->format(fn($value) => 
            $value 
                ? '<a href="' . Storage::url($value) . '" target="_blank" class="flex flex-row gap-1 justify-start items-center text-indigo-500 hover:text-indigo-800">View <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                    <path d="M6.22 8.72a.75.75 0 0 0 1.06 1.06l5.22-5.22v1.69a.75.75 0 0 0 1.5 0v-3.5a.75.75 0 0 0-.75-.75h-3.5a.75.75 0 0 0 0 1.5h1.69L6.22 8.72Z" />
                    <path d="M3.5 6.75c0-.69.56-1.25 1.25-1.25H7A.75.75 0 0 0 7 4H4.75A2.75 2.75 0 0 0 2 6.75v4.5A2.75 2.75 0 0 0 4.75 14h4.5A2.75 2.75 0 0 0 12 11.25V9a.75.75 0 0 0-1.5 0v2.25c0 .69-.56 1.25-1.25 1.25h-4.5c-.69 0-1.25-.56-1.25-1.25v-4.5Z" />
                </svg></a>' 
                : '-'
            )
            ->html()->sortable(), 
            Column::make("Remark", "remark")
                ->sortable()->searchable(),
            Column::make("Created at", "created_at")->format(fn($value) => Carbon::parse($value)->format('d-M-Y h:i A'))
                ->sortable(),
            Column::make("Updated at", "updated_at")->format(fn($value) => Carbon::parse($value)->format('d-M-Y h:i A'))->sortable(),
            Column::make('Actions')
                ->label(
                    fn($row, $column) => view('components.payment-action')->with(['payment' => $row])
                )->excludeFromColumnSelect(),
        ];
    }

    public function showEditForm($paymentId){ 
        $this->dispatch('editPayment', id: $paymentId);
    }

    public function deletePayment($paymentId)
    {
        $this->dispatch('deletePayment', id: $paymentId);
    }
}
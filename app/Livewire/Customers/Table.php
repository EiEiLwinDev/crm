<?php

namespace App\Livewire\Customers;

use App\Models\Application;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class Table extends DataTableComponent
{
    protected $listeners = ['customerCreated' => '$refresh', 'customerUpdated' => '$refresh', 'customerDeleted' => '$refresh'];

    public $statuses;
    public function mount(){
        $this->statuses = ['new' => 'New Customer', 'namelist' => 'Name List', 'medical_checkup' => 'Medical Check', 'buy_insurance' => 'Buy Insurance', 'wp_fee' => 'WP Fee', 'bt50' => 'BT-50', 'wp_permit', 'WP Permit'];
    }

    public function builder(): Builder
    {
        return User::query()->select('users.*')
        ->whereHas('customer.applications', function ($query) {
            $query->where('type', 'new_customer');
        })
        ->with(['customer.applications' => function ($query) {
            $query->where('type', 'new_customer');
        }]);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setBulkActionsEnabled()
        ->useComputedPropertiesDisabled()
        ->setDefaultSort('id', 'asc')
        ->setTableRowUrl(function($row) {
            return route('customers.view', $row->id);
        });
        $this->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('profile_photo_path')) {
                return [
                    'class' => 'w-[150px]',
                ];
            }
        
            return [];
        });
    }
    public function filters(): array
    {
        return [ 
            MultiSelectFilter::make('Status')
            ->options($this->statuses)
            ->setWireLive()
            ->filter(function (Builder $builder, array $values) {
            $builder->whereHas('customer.applications', function ($query) use ($values) {
                $query->where('type', 'new_customer')
                      ->whereIn('status', $values);
                });
            }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'customer_id')->sortable()->searchable(),
            ImageColumn::make('Photo', 'profile_photo_path')
            ->location(
                fn($row) => asset('storage/' .$row->profile_photo_path)
            )
            ->attributes(fn($row) => [
                'class' => 'profile-image rounded-full object-cover]',
                'alt' => $row->name
            ]),
            Column::make('Status')->label(fn($row) => view('components.status-badge', [
    'status' => $row->customer->applications->firstWhere('type', 'new_customer')?->status
            ])),

            Column::make('Name', 'name')->sortable()->searchable(), 
            Column::make('Phone', 'customer.phone')
                ->format(fn($value, $column, $row) => $value ?? '-')->sortable()->searchable(),

            Column::make('DOB', 'customer.dob')
                ->format(fn($value) => $value ? Carbon::parse($value)->format('d/m/Y') : '-'),

            Column::make('NRC', 'customer.nrc')
                ->format(fn($value, $column, $row) => $value ?? '-')->searchable(),

            Column::make('Passport', 'customer.passport')
                ->format(fn($value, $column, $row) => $value ?? '-')->searchable(),
                
            // Column::make('Created At', 'created_at')->sortable()->format(fn ($value) => Carbon::parse($value)->format('d/m/Y h:i A')),
            
            Column::make('Actions')
                ->label(
                    fn($row, $column) => view('components.customer-table-actions')->with(['user' => $row])
                )->excludeFromColumnSelect(),
 
        ];
    }

    public function bulkActions(): array
    {
        return [
            'markAsNameList' => 'Mark as Name List',
            'markAsNew' => 'Mark as New',
            'markAsMD' => 'Mark as Medical Checkup',
            'markAsBI' => 'Mark as Buy Insurance',
            'markAsWPFee' => 'Mark as WP Fee',
            'markAsBT50' => 'Mark as Bt-50',
            'markAsWPPermit' => 'Mark as WP Permit'
        ];
    }

    public function markAsNew()
    {
        $this->updateApplicationStatus('new');
    }

    public function markAsNameList()
    {
        $this->updateApplicationStatus('namelist');
    }

    public function markAsMD()
    {
        $this->updateApplicationStatus('medical_checkup'); 
    }

    public function markAsBI()
    {
        $this->updateApplicationStatus('buy_insurance');
    }
    
    public function markAsWPFee()
    {
        $this->updateApplicationStatus('wp_fee');
    }

    public function markAsBT50()
    {
        $this->updateApplicationStatus('bt50');
    }
    
    public function markAsWPPermit()
    {
        $this->updateApplicationStatus('wp_permit');
    }

    private function updateApplicationStatus(string $newStatus)
    {
        $selectedUserIds = $this->getSelected();

        if (empty($selectedUserIds)) {
            return;
        }

        Application::where('type', 'new_customer')
            ->whereHas('customer.user', function ($query) use ($selectedUserIds) {
                $query->whereIn('id', $selectedUserIds);
            })
            ->update(['status' => $newStatus]);

        $this->clearSelected();
    }


    public function editCustomer($userId)
    {
        $this->dispatch('editCustomer', userId: $userId);
    }

    public function deleteCustomer($userId)
    {
        $this->dispatch('deleteCustomer', userId: $userId);
    }

}
<?php

namespace App\Console\Commands;

use App\Interfaces\InvoiceRepositoryInterface;
use App\PurchaseItem;
use App\SalesItem;
use Illuminate\Console\Command;

class CopyInvoiceItemsToTable extends Command
{

    private $invoices;
    private $invRepo;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice-item:copy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copies invoice items from the invoice tables and put them in a seperate table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(InvoiceRepositoryInterface $invRepo)
    {
        parent::__construct();
        $this->invRepo= $invRepo;
        $this->invoices = $invRepo->allSalesInvoices(null);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // dd($this->invoices);
        //
        SalesItem::truncate();
        foreach ($this->invoices as $invoice) {
            // dump($invoice);
            $total = 0;
            $vat_amount = 0;
            // get the items off of the invoice table;
            $items = $invoice->items;
            foreach($items as $item){
                $dem = $item;
                $dem['invoice_id'] = $invoice->id;
                $total+= (double) $item['amount'];

                if($item['product_name'] == 'Unleaded 95'){
                    $vat_amount = 0.11 * (double) $item['amount'];
                    
                    if(array_key_exists('price_vat',$item) && ($item['price_vat'] == '' || $item['price_vat'] == null)){
                        $dem['price_vat'] = (double)$item['price'] * 1.11;
                    }
                    $dem['vat_amount'] = $vat_amount;
                    $dem['sub_total'] = $total-$vat_amount;
                }else{
                    $dem['sub_total'] = $total;
                }
                SalesItem::create($dem);
                // dump($dem);
            }

            // $invoice->sub_total = $total;
            // $invoice->vat_amount = $vat_amount;
            // $invoice->total += ($total+$vat_amount); 
            $invoice->items = null;
            $invoice->save();


            DB::table('sales_invoices')->drop('items');

            // $invoice->items = null;
            // $invoice->save();
            // $invoice->delete();

        }


        //TODO: try to drop the items column

        $this->info('Invoice Items Copy Complete');
    }
}

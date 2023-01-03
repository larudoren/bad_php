<?php

/**
 * Please, improve this class and fix all problems.
 *
 * You can change the Tenant class and its methods and properties as you want.
 * You can't change the AccountingService behavior.
 * You can choose PHP 7 or 8.
 * You can consider this class as an Eloquent model, so you are free to use
 * any Laravel methods and helpers.
 *
 * What is important:
 * - design (extensibility, testability)
 * - code cleanliness, following best practices
 * - consistency
 * - naming
 * - formatting
 *
 * Write your perfect code!
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model{
    public $accountingService;

    function __construct(){
        $this->accountingService = new \App\Services\AccountingService();
    }

    public function get_invoices()
    {
        $params = array('tenant_id' => $this->id, 'status' => 'awaiting-payment');
        $ap_invoices = $this->accountingService->getAllInvoices($params);
        if (!empty($ap_invoices))
        {
            return $ap_invoices;
        }

        return null;
    }

    public function get_old_invoices()
    {
        $params = array('tenant_id' => $this->id, 'status' => 'paid');
        $paid_invoices = $this->accountingService->getAllInvoices($params);

        if (!empty($paid_invoices)) {

            return $paid_invoices;
        }
        
        return null;
    }

    // ...
}

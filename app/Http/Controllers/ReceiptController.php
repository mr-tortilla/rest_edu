<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Receipt\ReceiptRepository;
use App\Http\Requests\Receipt\ReceiptRequest;
use http\Env\Response;

class ReceiptController extends Controller
{
    public function __construct(
        private ReceiptRepository $receipt_repo
    )
    {
    }

    public function create(ReceiptRequest $request)
    {
        $purchase_data = $request->validated();

        return ['response' => $this->receipt_repo->make($purchase_data)];

    }

    public function create_bg(ReceiptRequest $request)
    {
        $purchase_data = $request->validated();

        $this->receipt_repo->make_bg($purchase_data);
        return ['success' => true];
    }
}

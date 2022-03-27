<?php


namespace App\Helpers\Customer;


class DocumentFile
{
    public function createDocument($name,$customer,$category, $signable = false)
    {
        try {
            return $customer->documents()->create([
                "name" => $name,
                "customer_id" => $customer->id,
                "document_category_id" => $category,
                "signable" => $signable
            ]);
        }catch (\Exception $exception) {
            \Log::critical($exception);
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}

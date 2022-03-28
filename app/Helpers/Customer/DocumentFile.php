<?php


namespace App\Helpers\Customer;


class DocumentFile
{
    public function createDocument($name, $customer, $category, $reference = null, $signable = false, $signed_by_client = false, $signed_by_bank = false, $signed_at = null)
    {
        try {
            return $customer->documents()->create([
                "name" => $name,
                "customer_id" => $customer->id,
                "document_category_id" => $category,
                "signable" => $signable,
                "signed_by_client" => $signed_by_client,
                "signed_by_bank" => $signed_by_bank,
                "signed_at" => $signed_at,
                "reference" => $reference != null ? $reference : \Str::upper(\Str::random(10))
            ]);
        }catch (\Exception $exception) {
            \Log::critical($exception);
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}

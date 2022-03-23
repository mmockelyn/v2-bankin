<?php


namespace App\Helpers;


class BicSwiftCode
{
    /**
     * @var string
     */
    protected $locale;
    /**
     * @var array
     */
    protected $registry;

    /**
     * BankSwiftCode constructor.
     *
     * @param string $locale        The locale to apply on class, by default "fr"
     */
    public function __construct($locale = "fr")
    {
        $this->locale = $locale;
        $this->registry = array();

        if ($locale) {
            $this->loadRegistry();
        }
    }

    /**
     * Load registry given $locale
     *
     * @param string $locale        The locale file to load
     */
    public function loadSwiftCodesWithLocale($locale)
    {
        $this->locale = $locale;
        $this->loadRegistry();
    }

    /**
     * Get bank informations given swift code
     *
     * @param string $code          The swift code to find in registry
     * @return mixed|null           If true all bank informations, otherwise null
     */
    public function getBankInformationsBySwiftCode($code)
    {
        $results = array_filter($this->registry, function($entry) use ($code) {
            return $entry['swift_code'] === $code;
        });

        return collect($results);
    }

    /**
     * Get bank informations given bank identifier
     *
     * @param string $id            The identifier to find in registry
     * @return mixed|null           If true all bank informations, otherwise null
     */
    public function getBankInformationsById($id)
    {
        $results = array_filter($this->registry, function($entry) use ($id) {
            return $entry['bank_id'] === $id;
        });

        return $results;
    }

    /**
     * Get bank informations given bank name
     *
     * @param string $name          The name to find in registry
     * @return mixed|null           If true all bank informations, otherwise null
     */
    public function getBankInformationsByBankName($name)
    {
        $results = array_filter($this->registry, function($entry) use ($name) {
            return strtolower($entry['bank_name']) === strtolower($name);
        });

        return collect($results);
    }

    /**
     * Read file and load registry given intern locale
     */
    protected function loadRegistry()
    {
        $content = file_get_contents("https://raw.githubusercontent.com/PeterNotenboom/SwiftCodes/master/AllCountries/FR.json");

        foreach (json_decode($content)->list as $item) {
            array_push($this->registry, [
                "bank_id" => $item->id,
                "bank_city" => $item->city,
                "swift_code" => $item->swift_code,
                "branch_code" => $item->branch,
                "bank_name" => $item->bank
            ]);
        }
    }
}

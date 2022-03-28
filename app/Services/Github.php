<?php


namespace App\Services;


use Illuminate\Support\Str;

class Github
{
    public static function latestMasterVersion()
    {
        $gh = \GrahamCampbell\GitHub\Facades\GitHub::repo()->branches('mmockelyn', 'v2-bankin', 'master');

        return $gh['name'].'-'.Str::limit($gh['commit']['sha'], 5, '');
    }

    public static function latestDeployVersion()
    {
        $gh = \GrahamCampbell\GitHub\Facades\GitHub::repo()->releases()->latest('mmockelyn', 'v2-bankin');

        return $gh['tag_name'];
    }

    public static function GetWorkflows()
    {
        $gh = \GrahamCampbell\GitHub\Facades\GitHub::repo()->workflowRuns()->all('mmockelyn', 'v2-bankin');

        return $gh;
    }
}

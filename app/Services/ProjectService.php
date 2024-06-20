<?php

/*
|--------------------------------------------------------------------------
| ProjectService
|--------------------------------------------------------------------------
|
| Service to handle all sorts of operations regarding the projects.
|
*/

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    /**
     * Method to get the current project by header information.
     *
     * @return \App\Models\Project
     */
    public function getCurrentProject(): Project
    {
        $project_token = request()->headers->get('project_token', false);
        return Project::where('token', $project_token)->firstOrFail();
    }
}

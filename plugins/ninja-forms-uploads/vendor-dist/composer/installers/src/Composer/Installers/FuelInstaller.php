<?php

namespace NF_FU_VENDOR\Composer\Installers;

class FuelInstaller extends BaseInstaller
{
    protected $locations = array('module' => 'fuel/app/modules/{$name}/', 'package' => 'fuel/packages/{$name}/', 'theme' => 'fuel/app/themes/{$name}/');
}

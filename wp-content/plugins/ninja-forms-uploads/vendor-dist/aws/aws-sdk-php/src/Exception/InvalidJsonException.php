<?php

namespace NF_FU_VENDOR\Aws\Exception;

use NF_FU_VENDOR\Aws\HasMonitoringEventsTrait;
use NF_FU_VENDOR\Aws\MonitoringEventsInterface;
class InvalidJsonException extends \RuntimeException implements MonitoringEventsInterface
{
    use HasMonitoringEventsTrait;
}

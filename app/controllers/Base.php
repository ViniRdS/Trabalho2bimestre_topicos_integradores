<?php

namespace app\controllers;

use app\traits\Report;
use app\traits\Template;

abstract class Base
{
    use Template, Report;
}

<?php

namespace Bart\Ab;

use Namshi\AB\Container;
use Namshi\AB\Test;

class Ab
{
    private $tests = [];
    private $default = null;
    private $forcedVersion = null;

    public function __construct()
    {
        if (!session('ab_seed')) {
            session(['ab_seed' => mt_rand()]);
        }

        $this->tests = new Container([new Test('tests', $this->getTestsFromConfig())], session('ab_seed'));
        $this->default = config('ab.default', 'none');
    }

    public function getCurrentTest() {
        if (!$this->isEnabled()) {
            return $this->default;
        }

        return $this->forcedVersion !== null ? $this->forcedVersion : $this->tests['tests']->getVariation();
    }

    public function setForcedVersion($version) {
        $this->forcedVersion = $version;
    }

    private function getTestsFromConfig() {
        return config('ab.tests', []);
    }

    private function isEnabled() {
        return config('ab.enabled', false);
    }
}

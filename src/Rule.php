<?php
namespace Yjtec\Upload;

use Illuminate\Validation\Rule as IRule;

class Rule
{
    protected $config;
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getRule($type)
    {
        $types        = $this->config['types'];
        $rules        = $this->config['rules'];
        $defaultRules = ['required'];
        if ($rules) {
            $defaultRules = $rules;
        }
        if (isset($types[$type]['rules'])) {
            $defaultRules = $types[$type]['rules'];
        }
        return $defaultRules;
    }

    public function getTypes()
    {
        return IRule::in(array_keys($this->config['types']));
    }
}

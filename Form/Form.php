<?php

namespace Form;

use Exception\InvalidRuleException;
use Rule\Rule;

abstract class Form
{
    protected array $keys = [];
    protected array $data = [];
    protected array $validated = [];
    protected array $errors = [];

    /**
     * Form constructor.
     * @param array $data
     * @throws InvalidRuleException
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->keys = $this->keys();

        /** create Rule objects */
        foreach ($this->keys as $key => $rules) {
            /** each key can have 1 or more rules */
            if (!is_array($rules)) {
                $this->keys[$key] = $this->createRule($rules);
            } else {
                foreach ($rules as $ruleKey => $rule) {
                    $rules[$ruleKey] = $this->createRule($rule);
                }

                $this->keys[$key] = $rules;
            }
        }
    }

    abstract protected function keys(): array;

    /**
     * @param $rule
     * @return mixed
     * @throws InvalidRuleException
     */
    protected function createRule($rule)
    {
        if (is_object($rule) && $rule instanceof Rule) {
            return $rule;
        } elseif (in_array(Rule::class, class_parents($rule))) {
            return new $rule;
        } else {
            throw new InvalidRuleException('Class ' . $rule . ' must be an instance of ' . Rule::class);
        }
    }

    public function validate(): bool
    {
        foreach ($this->keys as $key => $rules) {
            $value = $this->data[$key] ?? null;

            if (!is_array($rules)) {
                $this->applyRule($rules, $key, $value);
            } else {
                foreach ($rules as $rule) {
                    $this->applyRule($rule, $key, $value);
                }
            }
        }

        foreach ($this->data as $key => $value) {
            $rulesForKey = $this->keys[$key];

            if (!$rulesForKey) {
                continue;
            }

            if (!is_array($rulesForKey)) {
                $this->applyRule($rulesForKey, $key, $value);
            } else {
                foreach ($rulesForKey as $rule) {
                    $this->applyRule($rule, $key, $value);
                }
            }
        }

        return empty($this->errors);
    }

    protected function applyRule(Rule $rule, string $key, $value): void
    {
        if ($rule->check($value)) {
            $this->validated[$key] = $value;
        } else {
            $this->errors[$key] = $rule->message();
        }
    }

    public function validated(): array
    {
        return $this->validated;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
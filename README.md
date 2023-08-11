# php-logger
## Issues
- It seems like `method_exists($this->obj, $method)` and `in_array($method, get_class_methods($this->obj))` work differently in __call<sub>method</sub> of WrapperLogTrait.php<sub>trait</sub>.
- In `parameterizedTestFunction(string $mes, int $num): void` of Wrapper.php<sub>class</sub> 
```angular2html
    protected function parameterizedTestFunction(string $mes, int $num): void
    {
        /**
         * $this->obj->parameterizedTestFunction($mes, $num);
         * !!!upper statement doesn't log(but why?); do that if you don't need to log the inner object's method calls(and don't use WrapperLogTrait)
         * @see use WrapperLogTrait, LogTrait above
         */

        /**
         * and below does log; do this if you want to log any inner object's function calls
         */
        $this->__wltCall('parameterizedTestFunction', array($mes, $num));

        echo 'Function Wrapper::parameterizedTestFunction output' . PHP_EOL;
    }
```
If I just call from here `$this->obj->parameterizedTestFunction($mes, $num)` method __call<sub>method</sub> won't be called though $this->obj **use**s LogTrait<sub>trait</sub> and parameterizedTestFunction($mes, $num)<sub>method</sub> is protected. So I had to write WrapperLogTrait<sub>trait</sub> and use it like this:
```angular2html
    use WrapperLogTrait, LogTrait {
        LogTrait::__call insteadof WrapperLogTrait;
        WrapperLogTrait::__call as __wltCall;
    }
```
```angular2html
    protected function parameterizedTestFunction(string $mes, int $num): void
    {
        $this->__wltCall('parameterizedTestFunction', array($mes, $num));
        echo 'Function Wrapper::parameterizedTestFunction output' . PHP_EOL;
    }
```
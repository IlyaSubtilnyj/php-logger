# php-logger
To use functionality you need to include **logging_plugin_pack**<sub>folder</sub> in your project.
## logging_plugin_pack<sub>folder</sub> consists of:
- Classes/Logger.php<sub>class</sub> - include main logging functionality; *is used by traits in **logging_plugin_pack/Traits/**<sub>folder</sub>*.
- Traits/LogTrait.php<sub>trait</sub> - should be **use**d in class whose actions needed to be logged.
- Traits/LogTraits.php<sub>trait</sub> - should be **use**d in class which represents the pattern Wrapper(Decorator) or any other realization of patterns that undermines inclusion entity of another class(Adapter,Composite,etc.).
## In this project you can also see:
- Classes/<sub>root directory folder</sub> whick includes:
    * TestClass.php<sub>class that **use**s LogTrait</sub> - an example of usage Traits/LogTrait.php<sub>trait</sub>.
    * Wrapper.php<sub>class</sub> - an example of wrapper class which includes TestClass.php<sub>class</sub> object as property(includes object).
    * AbstractTestClass<sub>abstract class</sub> - the class from which TestClass.php<sub>class</sub> and Wrapper.php<sub>class</sub> are inhereted.
- index.php<sub>file</sub> - an example of code(can be used for testing).
## User manual
- To log every action in **YourClass**<sub>class</sub> you need just ***use*** LogTrait<sub>trait</sub> in it. So:
```
class YourClass extends ParentClass {
  use LogTrait;
  protected function method1() {...}
  private function method2() {...}
  //other stuff
}
```
__Attention!__ Every method in YourClass<sub>class</sub> that needed to be logged should be protected or private (LogTrait<sub>trait</sub> uses __call<sub>php magic function</sub>), so any methods that are inhereted from PHP Interface can't be logged(they all have public access modifier), so I recommend you use abstract classes with abstract functions instead of interfaces (you can see an example in Classes/<sub>root directory folder</sub>).
- Wrapper case...
## Issues
- it seems like `method_exists(object|string $object_or_class, string $method):bool` and `in_array(string $method, get_class_methods(object|string $object_or_class))` in __call<sub>method</sub> of WrapperLogTrait.php<sub>trait</sub> work differently in this case. Putative cause: why get_class_methods return only one function __call<sub>method</sub> and doesn't return functions inhereted from AbstractTestClass<sub>class</sub>?
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
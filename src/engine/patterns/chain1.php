<?php

/*
Концептуальный пример
Этот пример показывает структуру паттерна Цепочка обязанностей, а именно — из каких классов он состоит, какие роли эти классы выполняют и как они взаимодействуют друг с другом.

После ознакомления со структурой, вам будет легче воспринимать второй пример, который рассматривает реальный случай использования паттерна в мире PHP.
*/

namespace RefactoringGuru\ChainOfResponsibility\Conceptual;

/**
 * Интерфейс Обработчика объявляет метод построения цепочки обработчиков. Он
 * также объявляет метод для выполнения запроса.
 */
interface Handler
{
    public function setNext(Handler $handler): Handler;

    public function handle(string $request): ?string;
}

/**
 * Поведение цепочки по умолчанию может быть реализовано внутри базового класса
 * обработчика.
 */
abstract class AbstractHandler implements Handler
{
    /**
     * @var Handler
     */
    private $nextHandler;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        // Возврат обработчика отсюда позволит связать обработчики простым
        // способом, вот так:
        // $monkey->setNext($squirrel)->setNext($dog);
        return $handler;
    }

    public function handle(string $request): ?string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($request);
        }

        return null;
    }
}

/**
 * Все Конкретные Обработчики либо обрабатывают запрос, либо передают его
 * следующему обработчику в цепочке.
 */
class MonkeyHandler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === "Banana") {
            return "Monkey: I'll eat the " . $request . ".\n";
        } else {
            return parent::handle($request);
        }
    }
}

class SquirrelHandler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === "Nut") {
            return "Squirrel: I'll eat the " . $request . ".\n";
        } else {
            return parent::handle($request);
        }
    }
}

class DogHandler extends AbstractHandler
{
    public function handle(string $request): ?string
    {
        if ($request === "MeatBall") {
            return "Dog: I'll eat the " . $request . ".\n";
        } else {
            return parent::handle($request);
        }
    }
}

/**
 * Обычно клиентский код приспособлен для работы с единственным обработчиком. В
 * большинстве случаев клиенту даже неизвестно, что этот обработчик является
 * частью цепочки.
 */
function clientCode(Handler $handler)
{
    foreach (["Nut", "Banana", "Cup of coffee"] as $food) {
        echo "Client: Who wants a " . $food . "?\n";
        $result = $handler->handle($food);
        if ($result) {
            echo "  " . $result;
        } else {
            echo "  " . $food . " was left untouched.\n";
        }
    }
}

/**
 * Другая часть клиентского кода создает саму цепочку.
 */
$monkey = new MonkeyHandler();
$squirrel = new SquirrelHandler();
$dog = new DogHandler();

$monkey->setNext($squirrel)->setNext($dog);

/**
 * Клиент должен иметь возможность отправлять запрос любому обработчику, а не
 * только первому в цепочке.
 */
echo "Chain: Monkey > Squirrel > Dog\n\n";
clientCode($monkey);
echo "\n";

echo "Subchain: Squirrel > Dog\n\n";
clientCode($squirrel);


//===
//Chain: Monkey > Squirrel > Dog

//Client: Who wants a Nut?
//  Squirrel: I'll eat the Nut.
//Client: Who wants a Banana?
//  Monkey: I'll eat the Banana.
//Client: Who wants a Cup of coffee?
//  Cup of coffee was left untouched.

//Subchain: Squirrel > Dog

//Client: Who wants a Nut?
//  Squirrel: I'll eat the Nut.
//Client: Who wants a Banana?
//  Banana was left untouched.
//Client: Who wants a Cup of coffee?
//  Cup of coffee was left untouched.
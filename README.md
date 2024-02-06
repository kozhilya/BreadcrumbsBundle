# Библиотека хлебных крошек

## Установка
```
composer require kozhilya/breadcrumbs-bundle
```

## Использование

### Описание крошек

Необходимо сервисом реализовать класс `AbstractDefenision`.

Пример реализации подобного класса:
```php
namespace App\Service\Breadcrumbs;

use Kozhilya\BreadcrumbsBundle\Breadcrumbs\AbstractDefinition;
use Kozhilya\BreadcrumbsBundle\Builder\Generator;
use Kozhilya\BreadcrumbsBundle\Builder\Item;
use Kozhilya\BreadcrumbsBundle\Nodes\RootNode;

class MainBreadcrumbs extends AbstractDefinition
{
    // В этом классе перечисляются доступные крошки
    public function getBreadcrumbs(): array
    {
        return [
            new RootNode(   // RootNode указывает, что крошка не имеет дополнительных параметров 
                'index',              // Имя хлебной крошки 
                 [$this, 'index']     // Метод, обрабатывающий содержимое
            ),
            new RootNode('login', [$this, 'login']),
            new ActionNode( // ActionNode указывает, что крошка относится к объектам некоторого класса 
                User::class,          // Класс, к которому относится крошка
                'index',              // Имя хлебной крошки может совпадать с другими, при условии, что классы различаются 
                [$this, 'userIndex']  // Метод, обрабатывающий содержимое
            ),
        ];
    }

    public function index(Generator $generator)
    {
        $path = $this->generateUrl('app_index');
        
        // $generator->append добавляет элемент хлебной крошки
        $generator->append("Главная страница", $path);
    }

    public function login(Generator $generator)
    {
        // $generator->parent указывает, какой элемент продолжает эта хлебная крошка
        $generator->parent('index');

        $path = $this->generateUrl('app_login');
        $generator->append("Вход в систему", $path);
    }
    
    public function userIndex(Generator $generator, User $user) // Второй аргумент - это объект, к которому относится крошка
    {
        $generator->parent('index');

        $name = $this->translator->trans('menu.comics', [], 'app');
        $path = $this->generateUrl('comic_list');

        $generator->append($user->getName(), $path);
    }
}
```

### Использование крошек

Пример файла `index.html.twig`
```twig
{% extends 'base.html.twig' %}
{% block title %}{% endblock %}

{% do set_breadcrumbs('index') %}

{# ... #}
```

Пример файла `login.html.twig`
```twig
{% extends 'base.html.twig' %}
{% block title %}Вход в систему{% endblock %}

{% do set_breadcrumbs('login') %}

{# ... #}
```

Пример файла `user/index.html.twig`
```twig
{% extends 'base.html.twig' %}
{% block title %}{{ user.name }}{% endblock %}

{% do set_breadcrumbs('index', user) %}

{# ... #}
```

### Вставка крошек

Пример файла `base.html.twig`
```twig
<body>
    {{ breadcrumbs() }}
    {% block content %}{% endblock %}
</body>
```


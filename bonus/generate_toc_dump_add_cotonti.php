<?php
/**
 * Генератор SQL-дампа для плагина toc_page
 * Добавляет дерево «Документация Cotonti» (ID 9) к существующим таблицам.
 * Элементы начинаются с ID 3000.
 * Основной язык: русский (item_title), дополнительный: английский (i18n, lang='en').
 * Скрипт не удаляет таблицы и не изменяет структуру. Только INSERT-запросы.
 */

$treeId = 9;
$startItemId = 3000;
$treeTitle = 'Документация Cotonti';
$treeDescription = 'База знаний по CMF Cotonti';

$html = <<<'HTML'
<ul>
    <li><nav></nav>Введение
        <ul>
            <li>О Cotonti</li>
            <li>Системные требования</li>
            <li>Лицензия</li>
            <li>Изменения в последних версиях</li>
        </ul>
    </li>
    <li><nav></nav>Начало работы
        <ul>
            <li>Быстрый старт</li>
            <li>Установка Cotonti</li>
            <li>Обновление Cotonti</li>
            <li>Первичная настройка</li>
            <li>Обзор панели управления</li>
        </ul>
    </li>
    <li><nav></nav>Основные понятия
        <ul>
            <li>Структура сайта</li>
            <li>Пользователи и группы</li>
            <li>Модули</li>
            <li>Плагины</li>
            <li>Темы</li>
            <li>Extrafields (дополнительные поля)</li>
            <li>Файлы и медиа</li>
            <li>Кэширование</li>
        </ul>
    </li>
    <li><nav></nav>Управление контентом
        <ul>
            <li><nav></nav>Страницы
                <ul>
                    <li>Создание и редактирование страниц</li>
                    <li>Типы страниц</li>
                    <li>Поля страницы</li>
                    <li>Extrafields страниц</li>
                    <li>Вложенные страницы и категории</li>
                    <li>Черновики и публикация</li>
                    <li>Массовые операции</li>
                </ul>
            </li>
            <li><nav></nav>Категории
                <ul>
                    <li>Создание и настройка категорий</li>
                    <li>Иерархия категорий</li>
                    <li>Extrafields категорий</li>
                    <li>Настройка отображения</li>
                </ul>
            </li>
            <li><nav></nav>Комментарии
                <ul>
                    <li>Управление комментариями</li>
                    <li>Модерация</li>
                    <li>Extrafields комментариев</li>
                </ul>
            </li>
            <li><nav></nav>Теги (метки)
                <ul>
                    <li>Применение тегов</li>
                    <li>Управление тегами</li>
                </ul>
            </li>
            <li><nav></nav>Медиафайлы
                <ul>
                    <li>Загрузка изображений, документов</li>
                    <li>Управление файлами</li>
                    <li>Встраивание в контент</li>
                </ul>
            </li>
        </ul>
    </li>
    <li><nav></nav>Администрирование
        <ul>
            <li><nav></nav>Конфигурация
                <ul>
                    <li>Основные настройки</li>
                    <li>Настройки безопасности</li>
                    <li>Настройки SEO</li>
                    <li>Настройки почты</li>
                    <li>Настройки производительности</li>
                </ul>
            </li>
            <li><nav></nav>Пользователи и права
                <ul>
                    <li>Создание и редактирование пользователей</li>
                    <li>Группы и роли</li>
                    <li>Права доступа (матрица прав)</li>
                    <li>Extrafields пользователей</li>
                </ul>
            </li>
            <li><nav></nav>Управление расширениями
                <ul>
                    <li>Установка модулей и плагинов</li>
                    <li>Активация/деактивация</li>
                    <li>Обновление расширений</li>
                    <li>Репозиторий расширений</li>
                </ul>
            </li>
            <li><nav></nav>Темы оформления
                <ul>
                    <li>Установка и переключение тем</li>
                    <li>Настройка параметров темы</li>
                </ul>
            </li>
            <li><nav></nav>Структура сайта
                <ul>
                    <li>Управление разделами и категориями</li>
                    <li>Перемещение контента</li>
                </ul>
            </li>
            <li><nav></nav>База данных
                <ul>
                    <li>Резервное копирование</li>
                    <li>Оптимизация таблиц</li>
                    <li>Выполнение SQL-запросов</li>
                </ul>
            </li>
            <li><nav></nav>Кэширование
                <ul>
                    <li>Очистка кэша</li>
                    <li>Настройка кэша</li>
                </ul>
            </li>
            <li><nav></nav>Журнал событий (логи)
                <ul>
                    <li>Просмотр ошибок</li>
                    <li>Действия пользователей</li>
                </ul>
            </li>
            <li><nav></nav>Безопасность
                <ul>
                    <li>Рекомендации по защите</li>
                    <li>Настройка HTTPS</li>
                    <li>Защита от взлома</li>
                </ul>
            </li>
            <li><nav></nav>Резервное копирование
                <ul>
                    <li>Автоматическое и ручное</li>
                    <li>Восстановление</li>
                </ul>
            </li>
        </ul>
    </li>
    <li><nav></nav>Разработка и кастомизация
        <ul>
            <li><nav></nav>Архитектура Cotonti
                <ul>
                    <li>Структура файлов и каталогов</li>
                    <li>Ядро, модули, плагины</li>
                    <li>Жизненный цикл запроса</li>
                </ul>
            </li>
            <li><nav></nav>API ядра
                <ul>
                    <li>Глобальные переменные и объекты</li>
                    <li>Функции ядра (cot_*)</li>
                    <li>Классы и методы</li>
                    <li>Константы</li>
                </ul>
            </li>
            <li><nav></nav>Хуки и события
                <ul>
                    <li>Что такое хуки</li>
                    <li>Регистрация хуков</li>
                    <li>Список доступных хуков</li>
                    <li>Примеры использования</li>
                </ul>
            </li>
            <li><nav></nav>Работа с базой данных
                <ul>
                    <li>Абстракция БД (Cot::$db)</li>
                    <li>Создание таблиц</li>
                    <li>Запросы, экранирование</li>
                    <li>Миграции</li>
                </ul>
            </li>
            <li><nav></nav>Шаблонизатор XTemplate
                <ul>
                    <li>Синтаксис</li>
                    <li>Переменные, блоки, условия</li>
                    <li>Работа с файлами шаблонов</li>
                </ul>
            </li>
            <li><nav></nav>Extrafields API (подробно)
                <ul>
                    <li>Что такое extrafields и их преимущества</li>
                    <li>Типы полей</li>
                    <li>Регистрация extrafields в реестре</li>
                    <li>Функции API</li>
                    <li>Примеры использования в плагинах и модулях</li>
                    <li>Расширение extrafields для собственных таблиц</li>
                    <li>Мультиязычность extrafields</li>
                </ul>
            </li>
            <li><nav></nav>Многоязычность
                <ul>
                    <li>Структура языковых файлов</li>
                    <li>Функции локализации</li>
                    <li>Перевод интерфейса</li>
                    <li>Локализация extrafields</li>
                </ul>
            </li>
            <li><nav></nav>Создание плагина
                <ul>
                    <li>Структура плагина</li>
                    <li>Мета-информация</li>
                    <li>Хуки плагина</li>
                    <li>Настройки плагина</li>
                    <li>Установка/удаление</li>
                    <li>Интеграция extrafields в плагин</li>
                </ul>
            </li>
            <li><nav></nav>Создание модуля
                <ul>
                    <li>Отличие модуля от плагина</li>
                    <li>Структура модуля</li>
                    <li>Контроллеры и маршруты</li>
                </ul>
            </li>
            <li><nav></nav>Создание темы
                <ul>
                    <li>Структура темы</li>
                    <li>Основные шаблоны</li>
                    <li>Стили и скрипты</li>
                    <li>Подключение ресурсов</li>
                </ul>
            </li>
            <li><nav></nav>Интеграция с внешними сервисами
                <ul>
                    <li>REST API</li>
                    <li>Webhooks</li>
                    <li>OAuth</li>
                </ul>
            </li>
            <li><nav></nav>Отладка и тестирование
                <ul>
                    <li>Режим отладки</li>
                    <li>Логирование</li>
                    <li>Профилирование</li>
                    <li>Юнит-тесты</li>
                </ul>
            </li>
        </ul>
    </li>
    <li><nav></nav>Справочник API
        <ul>
            <li><nav></nav>Функции ядра (по категориям)
                <ul>
                    <li>Работа со строками</li>
                    <li>Работа с БД</li>
                    <li>Работа с файлами</li>
                    <li>Работа с URL</li>
                    <li>Работа с пользователями</li>
                    <li>Работа с шаблонами</li>
                    <li>Работа с языками</li>
                </ul>
            </li>
            <li><nav></nav>Extrafields API (полный справочник)
                <ul>
                    <li>Все функции с описанием параметров и возвращаемых значений</li>
                    <li>Константы и глобальные переменные</li>
                    <li>Типы полей и их параметры</li>
                    <li>События и хуки, связанные с extrafields</li>
                </ul>
            </li>
            <li><nav></nav>Классы
                <ul>
                    <li>Cot</li>
                    <li>CotDB</li>
                    <li>XTemplate</li>
                    <li>Cot::$usr, Cot::$cfg и др.</li>
                </ul>
            </li>
            <li><nav></nav>Хуки (полный список)
                <ul>
                    <li>Системные хуки</li>
                    <li>Хуки модулей</li>
                    <li>Хуки плагинов</li>
                    <li>Хуки extrafields</li>
                </ul>
            </li>
            <li>События (событийная модель)</li>
            <li><nav></nav>Структура таблиц БД
                <ul>
                    <li>Основные таблицы</li>
                    <li>Таблицы расширений</li>
                </ul>
            </li>
        </ul>
    </li>
    <li><nav></nav>Расширения (экосистема)
        <ul>
            <li><nav></nav>Официальный репозиторий
                <ul>
                    <li>Поиск и установка</li>
                </ul>
            </li>
            <li><nav></nav>Популярные модули
                <ul>
                    <li>Документация по каждому крупному модулю</li>
                </ul>
            </li>
            <li><nav></nav>Популярные плагины
                <ul>
                    <li>Документация по каждому популярному плагину</li>
                </ul>
            </li>
            <li><nav></nav>Сторонние ресурсы
                <ul>
                    <li>Форумы, блоги, GitHub</li>
                </ul>
            </li>
        </ul>
    </li>
    <li><nav></nav>Темы и дизайн
        <ul>
            <li><nav></nav>Руководство по созданию тем
                <ul>
                    <li>Начало работы</li>
                    <li>Структура файлов</li>
                    <li>Шаблоны основных страниц</li>
                    <li>Использование Bootstrap / других фреймворков</li>
                </ul>
            </li>
            <li><nav></nav>Готовые темы
                <ul>
                    <li>Каталог тем</li>
                    <li>Установка и настройка</li>
                </ul>
            </li>
            <li>Адаптивность и мобильная версия</li>
        </ul>
    </li>
    <li><nav></nav>Сообщество и поддержка
        <ul>
            <li>Официальный сайт и форум</li>
            <li><nav></nav>Баг-трекер
                <ul>
                    <li>Как сообщать об ошибках</li>
                </ul>
            </li>
            <li><nav></nav>Участие в разработке
                <ul>
                    <li>Как внести вклад (pull request)</li>
                    <li>Правила оформления кода</li>
                </ul>
            </li>
            <li>Лицензионные вопросы</li>
        </ul>
    </li>
    <li><nav></nav>FAQ (Часто задаваемые вопросы)
        <ul>
            <li>Общие вопросы</li>
            <li>Установка и обновление</li>
            <li>Работа с контентом</li>
            <li>Пользователи и права</li>
            <li>Extrafields</li>
            <li>Разработка</li>
            <li>Ошибки и их решение</li>
        </ul>
    </li>
    <li><nav></nav>Глоссарий
        <ul>
            <li>Термины, используемые в Cotonti</li>
        </ul>
    </li>
</ul>
HTML;

$translations = [
    'Введение' => 'Introduction',
    'О Cotonti' => 'About Cotonti',
    'Системные требования' => 'System Requirements',
    'Лицензия' => 'License',
    'Изменения в последних версиях' => 'Changelog',
    'Начало работы' => 'Getting Started',
    'Быстрый старт' => 'Quick Start',
    'Установка Cotonti' => 'Installation',
    'Обновление Cotonti' => 'Upgrade',
    'Первичная настройка' => 'Initial Setup',
    'Обзор панели управления' => 'Admin Panel Overview',
    'Основные понятия' => 'Core Concepts',
    'Структура сайта' => 'Site Structure',
    'Пользователи и группы' => 'Users and Groups',
    'Модули' => 'Modules',
    'Плагины' => 'Plugins',
    'Темы' => 'Themes',
    'Extrafields (дополнительные поля)' => 'Extra Fields',
    'Файлы и медиа' => 'Files and Media',
    'Кэширование' => 'Caching',
    'Управление контентом' => 'Content Management',
    'Страницы' => 'Pages',
    'Создание и редактирование страниц' => 'Creating and Editing Pages',
    'Типы страниц' => 'Page Types',
    'Поля страницы' => 'Page Fields',
    'Extrafields страниц' => 'Page Extra Fields',
    'Вложенные страницы и категории' => 'Nested Pages and Categories',
    'Черновики и публикация' => 'Drafts and Publishing',
    'Массовые операции' => 'Bulk Operations',
    'Категории' => 'Categories',
    'Создание и настройка категорий' => 'Creating and Configuring Categories',
    'Иерархия категорий' => 'Category Hierarchy',
    'Extrafields категорий' => 'Category Extra Fields',
    'Настройка отображения' => 'Display Settings',
    'Комментарии' => 'Comments',
    'Управление комментариями' => 'Managing Comments',
    'Модерация' => 'Moderation',
    'Extrafields комментариев' => 'Comment Extra Fields',
    'Теги (метки)' => 'Tags',
    'Применение тегов' => 'Using Tags',
    'Управление тегами' => 'Managing Tags',
    'Медиафайлы' => 'Media Files',
    'Загрузка изображений, документов' => 'Uploading Images and Documents',
    'Управление файлами' => 'File Management',
    'Встраивание в контент' => 'Embedding Content',
    'Администрирование' => 'Administration',
    'Конфигурация' => 'Configuration',
    'Основные настройки' => 'Basic Settings',
    'Настройки безопасности' => 'Security Settings',
    'Настройки SEO' => 'SEO Settings',
    'Настройки почты' => 'Mail Settings',
    'Настройки производительности' => 'Performance Settings',
    'Пользователи и права' => 'Users and Permissions',
    'Создание и редактирование пользователей' => 'Creating and Editing Users',
    'Группы и роли' => 'Groups and Roles',
    'Права доступа (матрица прав)' => 'Permission Matrix',
    'Extrafields пользователей' => 'User Extra Fields',
    'Управление расширениями' => 'Extension Management',
    'Установка модулей и плагинов' => 'Installing Modules and Plugins',
    'Активация/деактивация' => 'Activation/Deactivation',
    'Обновление расширений' => 'Updating Extensions',
    'Репозиторий расширений' => 'Extension Repository',
    'Темы оформления' => 'Themes',
    'Установка и переключение тем' => 'Installing and Switching Themes',
    'Настройка параметров темы' => 'Theme Configuration',
    'Структура сайта' => 'Site Structure',
    'Управление разделами и категориями' => 'Managing Sections and Categories',
    'Перемещение контента' => 'Moving Content',
    'База данных' => 'Database',
    'Резервное копирование' => 'Backup',
    'Оптимизация таблиц' => 'Table Optimization',
    'Выполнение SQL-запросов' => 'Running SQL Queries',
    'Кэширование' => 'Caching',
    'Очистка кэша' => 'Clearing Cache',
    'Настройка кэша' => 'Cache Configuration',
    'Журнал событий (логи)' => 'Event Logs',
    'Просмотр ошибок' => 'Viewing Errors',
    'Действия пользователей' => 'User Actions',
    'Безопасность' => 'Security',
    'Рекомендации по защите' => 'Protection Recommendations',
    'Настройка HTTPS' => 'HTTPS Setup',
    'Защита от взлома' => 'Hack Prevention',
    'Автоматическое и ручное' => 'Automatic and Manual Backup',
    'Восстановление' => 'Restore',
    'Разработка и кастомизация' => 'Development and Customization',
    'Архитектура Cotonti' => 'Cotonti Architecture',
    'Структура файлов и каталогов' => 'File and Directory Structure',
    'Ядро, модули, плагины' => 'Core, Modules, Plugins',
    'Жизненный цикл запроса' => 'Request Lifecycle',
    'API ядра' => 'Core API',
    'Глобальные переменные и объекты' => 'Global Variables and Objects',
    'Функции ядра (cot_*)' => 'Core Functions (cot_*)',
    'Классы и методы' => 'Classes and Methods',
    'Константы' => 'Constants',
    'Хуки и события' => 'Hooks and Events',
    'Что такое хуки' => 'What are Hooks',
    'Регистрация хуков' => 'Registering Hooks',
    'Список доступных хуков' => 'Available Hooks',
    'Примеры использования' => 'Usage Examples',
    'Работа с базой данных' => 'Database Interaction',
    'Абстракция БД (Cot::$db)' => 'Database Abstraction (Cot::$db)',
    'Создание таблиц' => 'Creating Tables',
    'Запросы, экранирование' => 'Queries and Escaping',
    'Миграции' => 'Migrations',
    'Шаблонизатор XTemplate' => 'XTemplate Engine',
    'Синтаксис' => 'Syntax',
    'Переменные, блоки, условия' => 'Variables, Blocks, Conditions',
    'Работа с файлами шаблонов' => 'Working with Template Files',
    'Extrafields API (подробно)' => 'Extra Fields API (Details)',
    'Что такое extrafields и их преимущества' => 'What are Extra Fields and Their Benefits',
    'Типы полей' => 'Field Types',
    'Регистрация extrafields в реестре' => 'Registering Extra Fields',
    'Функции API' => 'API Functions',
    'Примеры использования в плагинах и модулях' => 'Usage Examples in Plugins and Modules',
    'Расширение extrafields для собственных таблиц' => 'Extending Extra Fields for Custom Tables',
    'Мультиязычность extrafields' => 'Multilingual Extra Fields',
    'Многоязычность' => 'Multilingual Support',
    'Структура языковых файлов' => 'Language File Structure',
    'Функции локализации' => 'Localization Functions',
    'Перевод интерфейса' => 'Interface Translation',
    'Локализация extrafields' => 'Localizing Extra Fields',
    'Создание плагина' => 'Creating a Plugin',
    'Структура плагина' => 'Plugin Structure',
    'Мета-информация' => 'Meta Information',
    'Хуки плагина' => 'Plugin Hooks',
    'Настройки плагина' => 'Plugin Settings',
    'Установка/удаление' => 'Install/Uninstall',
    'Интеграция extrafields в плагин' => 'Integrating Extra Fields into a Plugin',
    'Создание модуля' => 'Creating a Module',
    'Отличие модуля от плагина' => 'Module vs Plugin',
    'Структура модуля' => 'Module Structure',
    'Контроллеры и маршруты' => 'Controllers and Routes',
    'Создание темы' => 'Creating a Theme',
    'Структура темы' => 'Theme Structure',
    'Основные шаблоны' => 'Basic Templates',
    'Стили и скрипты' => 'Styles and Scripts',
    'Подключение ресурсов' => 'Resource Loading',
    'Интеграция с внешними сервисами' => 'External Service Integration',
    'REST API' => 'REST API',
    'Webhooks' => 'Webhooks',
    'OAuth' => 'OAuth',
    'Отладка и тестирование' => 'Debugging and Testing',
    'Режим отладки' => 'Debug Mode',
    'Логирование' => 'Logging',
    'Профилирование' => 'Profiling',
    'Юнит-тесты' => 'Unit Tests',
    'Справочник API' => 'API Reference',
    'Функции ядра (по категориям)' => 'Core Functions (by Category)',
    'Работа со строками' => 'String Functions',
    'Работа с БД' => 'Database Functions',
    'Работа с файлами' => 'File Functions',
    'Работа с URL' => 'URL Functions',
    'Работа с пользователями' => 'User Functions',
    'Работа с шаблонами' => 'Template Functions',
    'Работа с языками' => 'Language Functions',
    'Extrafields API (полный справочник)' => 'Extra Fields API (Full Reference)',
    'Все функции с описанием параметров и возвращаемых значений' => 'All Functions with Parameters and Return Values',
    'Константы и глобальные переменные' => 'Constants and Global Variables',
    'Типы полей и их параметры' => 'Field Types and Parameters',
    'События и хуки, связанные с extrafields' => 'Events and Hooks Related to Extra Fields',
    'Классы' => 'Classes',
    'Cot' => 'Cot',
    'CotDB' => 'CotDB',
    'XTemplate' => 'XTemplate',
    'Cot::$usr, Cot::$cfg и др.' => 'Cot::$usr, Cot::$cfg, etc.',
    'Хуки (полный список)' => 'Hooks (Complete List)',
    'Системные хуки' => 'System Hooks',
    'Хуки модулей' => 'Module Hooks',
    'Хуки плагинов' => 'Plugin Hooks',
    'Хуки extrafields' => 'Extra Fields Hooks',
    'События (событийная модель)' => 'Events (Event Model)',
    'Структура таблиц БД' => 'Database Table Structure',
    'Основные таблицы' => 'Core Tables',
    'Таблицы расширений' => 'Extension Tables',
    'Расширения (экосистема)' => 'Extensions (Ecosystem)',
    'Официальный репозиторий' => 'Official Repository',
    'Поиск и установка' => 'Search and Installation',
    'Популярные модули' => 'Popular Modules',
    'Документация по каждому крупному модулю' => 'Documentation for Each Major Module',
    'Популярные плагины' => 'Popular Plugins',
    'Документация по каждому популярному плагину' => 'Documentation for Each Popular Plugin',
    'Сторонние ресурсы' => 'Third-party Resources',
    'Форумы, блоги, GitHub' => 'Forums, Blogs, GitHub',
    'Темы и дизайн' => 'Themes and Design',
    'Руководство по созданию тем' => 'Theme Development Guide',
    'Начало работы' => 'Getting Started',
    'Структура файлов' => 'File Structure',
    'Шаблоны основных страниц' => 'Main Page Templates',
    'Использование Bootstrap / других фреймворков' => 'Using Bootstrap / Other Frameworks',
    'Готовые темы' => 'Ready Themes',
    'Каталог тем' => 'Theme Catalog',
    'Установка и настройка' => 'Installation and Configuration',
    'Адаптивность и мобильная версия' => 'Responsiveness and Mobile Version',
    'Сообщество и поддержка' => 'Community and Support',
    'Официальный сайт и форум' => 'Official Website and Forum',
    'Баг-трекер' => 'Bug Tracker',
    'Как сообщать об ошибках' => 'How to Report Bugs',
    'Участие в разработке' => 'Contributing',
    'Как внести вклад (pull request)' => 'How to Contribute (Pull Request)',
    'Правила оформления кода' => 'Code Style Guidelines',
    'Лицензионные вопросы' => 'Licensing Issues',
    'FAQ (Часто задаваемые вопросы)' => 'FAQ',
    'Общие вопросы' => 'General Questions',
    'Установка и обновление' => 'Installation and Upgrade',
    'Работа с контентом' => 'Content Management',
    'Пользователи и права' => 'Users and Permissions',
    'Extrafields' => 'Extra Fields',
    'Разработка' => 'Development',
    'Ошибки и их решение' => 'Errors and Solutions',
    'Глоссарий' => 'Glossary',
    'Термины, используемые в Cotonti' => 'Terms Used in Cotonti',
];

// Парсинг HTML
$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
libxml_clear_errors();

$xpath = new DOMXPath($dom);
$topLevelUls = $xpath->query('//ul');
if ($topLevelUls->length === 0) die('Не найден корневой <ul>');
$rootUl = $topLevelUls->item(0);

$items = [];
$nextItemId = $startItemId;
$parentStack = [0];

function processUl(DOMElement $ul, array &$items, array &$parentStack, int &$nextItemId): void
{
    foreach ($ul->childNodes as $li) {
        if ($li->nodeName !== 'li') continue;
        $title = '';
        foreach ($li->childNodes as $child) {
            if ($child->nodeName === 'nav') continue;
            if ($child->nodeName === 'ul') continue;
            if ($child->nodeType === XML_TEXT_NODE || $child->nodeType === XML_CDATA_SECTION_NODE) {
                $title .= $child->nodeValue;
            } elseif ($child->nodeType === XML_ELEMENT_NODE) {
                $title .= $child->textContent;
            }
        }
        $title = trim(preg_replace('/\s+/u', ' ', $title));
        if ($title === '') continue;
        $parentId = end($parentStack);
        $items[] = ['id' => $nextItemId, 'parent' => $parentId, 'title' => $title];
        $currentId = $nextItemId;
        $nextItemId++;
        $childUl = null;
        foreach ($li->childNodes as $child) {
            if ($child->nodeName === 'ul') { $childUl = $child; break; }
        }
        if ($childUl !== null) {
            $parentStack[] = $currentId;
            processUl($childUl, $items, $parentStack, $nextItemId);
            array_pop($parentStack);
        }
    }
}
processUl($rootUl, $items, $parentStack, $nextItemId);

// Генерация SQL
$sql = [];
$sql[] = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";";
$sql[] = "START TRANSACTION;";
$sql[] = "";
$sql[] = "INSERT INTO `cot_toc_page_trees` (`tree_id`, `tree_title`, `tree_description`, `tree_created`, `tree_updated`) VALUES";
$sql[] = sprintf("(%d, '%s', '%s', UNIX_TIMESTAMP(), UNIX_TIMESTAMP());", $treeId, addslashes($treeTitle), addslashes($treeDescription));
$sql[] = "";
$sql[] = "INSERT INTO `cot_toc_page_items` (`item_id`, `tree_id`, `parent_id`, `item_type`, `item_ref`, `item_title`, `item_url`, `item_sort`, `item_enabled`) VALUES";

$itemsByParent = [];
foreach ($items as $item) $itemsByParent[$item['parent']][] = $item;

function buildItemLinesAdd(array $itemsByParent, int $parentId, int $treeId): array
{
    $lines = [];
    foreach ($itemsByParent[$parentId] ?? [] as $index => $item) {
        $sort = $index + 1;
        $titleEscaped = addslashes($item['title']);
        $lines[] = sprintf("(%d, %d, %d, 'custom', '', '%s', '', %d, 1)", $item['id'], $treeId, $parentId, $titleEscaped, $sort);
        $lines = array_merge($lines, buildItemLinesAdd($itemsByParent, $item['id'], $treeId));
    }
    return $lines;
}
$itemLines = buildItemLinesAdd($itemsByParent, 0, $treeId);
foreach ($itemLines as $i => $line) {
    $suffix = ($i === count($itemLines) - 1) ? ";" : ",";
    $sql[] = $line . $suffix;
}
$sql[] = "";

$sql[] = "INSERT INTO `cot_toc_page_i18n` (`item_id`, `field_name`, `lang`, `value`) VALUES";
$i18nLines = [];
foreach ($items as $item) {
    $ruTitle = $translations[$item['title']] ?? $item['title'];
    $ruTitleEscaped = addslashes($ruTitle);
    $i18nLines[] = sprintf("(%d, 'item_title', 'en', '%s')", $item['id'], $ruTitleEscaped);
}
foreach ($i18nLines as $i => $line) {
    $suffix = ($i === count($i18nLines) - 1) ? ";" : ",";
    $sql[] = $line . $suffix;
}
$sql[] = "";
$sql[] = "COMMIT;";

$dump = implode("\n", $sql) . "\n";

$fileName = 'toc_page_add_' . date('Ymd_His') . '.sql';
$filePath = __DIR__ . '/' . $fileName;
$writeResult = file_put_contents($filePath, $dump);

if ($writeResult !== false) {
    echo "SQL-дамп для добавления дерева сохранён: {$fileName}\n";
    echo "Размер файла: " . round(filesize($filePath) / 1024, 2) . " КБ\n";
} else {
    echo "Ошибка записи файла. Проверьте права на запись в директорию.";
}
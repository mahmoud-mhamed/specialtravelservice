<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" class="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;700&display=swap" rel="stylesheet">
    @vite('resources/js/app.js')
    @inertiaHead
    @routes
</head>
<body class="min-h-fit text-start font-messiri bg-neutral-50 dark:bg-dark-500">
@inertia
</body>
</html>

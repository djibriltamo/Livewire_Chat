<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Class Namespace
    |--------------------------------------------------------------------------
    |
    | Cette valeur est utilisée pour déterminer l'espace de nom des classes
    | Livewire générées par les commandes artisan. Cela inclut l'espace de
    | nom pour les composants ainsi que pour d'autres classes comme les traits.
    |
    */

    'class_namespace' => 'App\\Http\\Livewire',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Si tu souhaites appliquer un middleware à toutes les requêtes Livewire,
    | tu peux les spécifier ici. Cela peut être utile pour appliquer des
    | règles d'authentification ou autres sur tes composants.
    |
    */

    'middleware_group' => null,

    /*
    |--------------------------------------------------------------------------
    | Dirty Checks
    |--------------------------------------------------------------------------
    |
    | Cette option te permet de configurer comment Livewire doit gérer les
    | modifications des données dans tes composants.
    |
    */

    'dirty_check' => true,

    /*
    |--------------------------------------------------------------------------
    | Optimisation des fichiers Blade
    |--------------------------------------------------------------------------
    |
    | Active ou désactive l'optimisation des vues Blade pour les composants
    | Livewire. Cela peut aider à améliorer la performance en production.
    |
    */

    'optimize_views' => true,

    /*
    |--------------------------------------------------------------------------
    | Autres configurations Livewire
    |--------------------------------------------------------------------------
    |
    | Tu peux ajouter ici d'autres paramètres que tu veux surcharger
    | en fonction de tes besoins pour ton application Livewire.
    |
    */
];

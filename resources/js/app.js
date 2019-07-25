/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');


window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});



jQuery(document).ready(function($){
    $.extend( $.fn.dataTable.defaults, {
        'order': [
            [0, 'asc']
        ],
        'pagingType': 'simple_numbers',
        'scrollX': false,
        responsive: true,
        'lengthMenu': [
            [10, 25, 50, -1],
            [10, 25, 50, 'Todos']
        ],
        language: {
            processing: 'Aguarde...',
            search: 'Buscar na tabela:',
            lengthMenu: 'Mostrar _MENU_ registros',
            info: 'Exibição _START_ até _END_ de _TOTAL_ elemento elementos',
            infoEmpty: 'Exibição 0 até 0 de 0 elementos',
            infoFiltered: '(esxistem _MAX_ registros no total da tabela)',
            infoPostFix: '',
            loadingRecords: 'Carregando...',
            zeroRecords: 'Sem  dados para visualização nomento',
            emptyTable: 'Sem dados disponíveis na tabela',
            paginate: {
                first: 'Primeiro',
                previous: 'Anterior',
                next: 'Próximo',
                last: 'Último'
            },
            aria: {
                sortAscending: ': permitem classificar a coluna em ordem crescente',
                sortDescending: ': permitem classificar a coluna em ordem decrescente'
            }
        }
    });



});

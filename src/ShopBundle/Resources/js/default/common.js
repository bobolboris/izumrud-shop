$(document).ready(init);

var app2 = null;
var onCurrencyChanged = null;
var sortByNameUp = function(d1, d2){return d1.name.toLowerCase() > d2.name.toLowerCase()};
var sortByNameDown = function(d2, d1){return d1.name.toLowerCase() > d2.name.toLowerCase()};
var sortByPriceUp = function(d1, d2){return d1.price > d2.price};
var sortByPriceDown = function(d2, d1){return d1.price > d2.price};
function init() {
    app2 = new Vue({
        el: '#head',
        delimiters: ['${', '}'],
        data:{
            currency: {id: '', name: '', coef: 1},
            sum: 0,
            cart: [],
            cmpList: [],
            path: '',
            searchData: '',
            searchOptions: []
        },
        methods:{
            onButtonSetCurrencyClick: function (event) {
                let view = event.target;
                let thi1s = this;
                $.post('/ajax/setCurrency', { id: view.getAttribute("value") }, function (response) {
                    if(response !== null){
                        if(response['ok'] === true){
                            thi1s.currency = {id: view.getAttribute("value"), name: view.innerHTML, coef: view.getAttribute("coef")};
                        }else{
                            alert('Ошибка смены валюты');
                        }
                    }
                });
            },
            submitAction: function (event) { if(event.keyCode === 13) this.searchAction(); },
            searchAction: function () { window.location = this.path + this.searchData; },
            addToCompareList: function(id){
                let _this = this;
                $.post('/ajax/addProductToCompareList', { 'id': id }, function (response) {
                    if(response !== null){
                        if(response['ok'] === true){
                            _this.cmpList.push(id);
                        }else{
                            alert('Ошибка добавления');
                        }
                    }
                });
            }
        },
        computed:{
            sumC: function () {
                return (this.sum / this.currency.coef).toFixed(0);
            }
        },
        watch: {
            currency: function (newv, oldv) {
                if(onCurrencyChanged !== null)
                    onCurrencyChanged(newv, oldv);
            },
            searchData: function (newv, oldv) {
                if(newv === '')
                    app2.searchOptions.splice(0, this.searchOptions.length);
                let _this = this;
                $.post('/ajax/search', { data: newv }, function (response) {
                    if(response !== null){
                        if(response['ok'] === true){
                            let products = response['products'];
                            if(products !== undefined && products.length > 0){
                                app2.searchOptions.splice(0, app2.searchOptions.length);
                                for(let i in products){
                                    app2.searchOptions.push(products[i]);
                                }
                            }else{
                                app2.searchOptions.splice(0, app2.searchOptions.length);
                            }
                        }
                    }
                });
            }
        }

    });
    fillApp2();
}
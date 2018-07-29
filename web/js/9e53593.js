$(document).ready(init);

function right(ev){
    var leave = function(ev){
        $(ev.target).parent().find('.item-wrapper').css('display', 'none');
        return false;
    }

    $('.one').mouseenter(function (ev) {
        $(ev.target).parent().find('.item-wrapper').css('display', 'block');
        return false;
    });

    $('.one').mouseleave(leave);
    $('.item-wrapper').mouseleave(function (ev) {
        $(ev.target).parent().css('display', 'none');
    });



    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()){
            if(app.isEnd || app.getMaxId() === -1 || app.targetId === -1 || app.stamp === -1) return;

            app.loaded = true;
            $.post('/ajax/loadMoreProducts', {'stamp': app.stamp, 'maxId': app.getMaxId(), 'targetId': app.targetId}, function (response) {
                if(response !== null){
                    if(response['ok'] === true){
                        app.loaded = false;
                        if(response['length'] === 0){
                            app.isEnd = true;
                            return;
                        }
                        let products = response['products'];
                        for(let i = 0; i < products.length; i++){
                            products[i]['sprice'] = products[i]['price'];
                            app.products.push(products[i]);
                        }
                    }
                }
            });

        }
    });

}
var app = null;
function init(ev) {
    right(ev);
    app = new Vue({
        el: '#app',
        delimiters: ['${', '}'],
        data:{
            products: [],
            sortParam: '1',
            loaded: false,
            isEnd: false,
            stamp: -1,
            targetId: -1
        },
        computed:{
            productsList: function () {
                for(let i = 0; i < this.products.length; i++){
                    this.products[i].price = (this.products[i].sprice / app2.currency.coef).toFixed();
                }
                switch (this.sortParam){
                    case '1': return this.products.sort(sortByNameUp);
                    case '2': return this.products.sort(sortByNameDown);
                    case '3': return this.products.sort(sortByPriceUp);
                    case '4': return this.products.sort(sortByPriceDown);
                    default: return this.products;
                }
            }
        },
        methods:{
            buy: function (id) {
                $.post('/ajax/addToCart', {'id': id}, function (response) {
                    if(response !== null){
                        if(response['ok'] === true){
                            app2.cart.push(id);
                            app2.sum = parseInt(response['sum']);
                        }
                    }
                });
            },
            addToCompareList: function (id) {
                app2.addToCompareList(id);
            },
            getMaxId: function () {
                let id = -1;
                for(let i = 0; i < this.products.length; i++){
                    if(this.products[i].id > id){
                        id = this.products[i].id;
                    }
                }
                return id;
            }
        }
    });
    fill();
    onCurrencyChanged = function (newv, oldv) {
        for(let i = 0; i < app.products.length; i++){
            app.products[i].price = (app.products[i].sprice / newv.coef).toFixed();
        }
    }

}


$(document).ready(init);

function sliderLoad() {
    $(".lazy").slick({
        lazyLoad: 'ondemand',
        infinite: true
    });
}

var app = null;
function init() {
    sliderLoad();
    app = new Vue({
        el: '#app',
        delimiters: ['${', '}'],
        data:{
            products: [],
        },
        computed:{
            productsList: function () {
                for(let i = 0; i < this.products.length; i++){
                    this.products[i].price = (this.products[i].sprice / app2.currency.coef).toFixed();
                }
                return this.products;
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
            }
        }
    });
    fill();
    onCurrencyChanged = function (newv, oldv) {
        // for(let i = 0; i < app.products.length; i++){
        //     app.products[i].price = (app.products[i].sprice / newv.coef).toFixed();
        // }
    }
}

$(document).ready(init);
var app = null;
function init() {
    app = new Vue({
        el: '#app',
        delimiters: ['${', '}'],
        data:{
            products: [],
            sumS: 0
        },
        methods:{
            remove: function (index) {
                $.post('/ajax/removeAction', {'id': this.products[index].id}, function (response) {
                    if(response !== null){
                        if(response['ok'] === true){
                            app.products.splice(index, 1);
                            app2.cart.splice(index, 1);
                        }
                    }
                });
            },
            submit: function () {
                if(this.products.length <= 0) {
                    alert('Корзина пуста');
                    return;
                }
                $.post('/ajax/addOrder', {'products': this.products}, function (response) {
                    if(response !== null){
                        if(response['ok'] === true){
                            window.location = '/registration/' + response['code'];
                        }
                    }
                });
            }
        },
        computed:{
            sum: function () {
                let sum = 0;
                let sumS = 0;
                for(let i = 0; i < this.products.length; i++){
                    let tmp = parseFloat(this.products[i]['count']);
                    if(isNaN(tmp) || tmp === 0){
                        tmp = 1;
                    }
                    sum += parseFloat(this.products[i]['price'] * tmp);
                    sumS += parseFloat(this.products[i]['sprice'] * tmp);
                }
                this.sumS = sum;
                app2.sum = sum;
                return sum;
            },
            productsList: function () {
                for(let i = 0; i < this.products.length; i++){
                    this.products[i].price = (this.products[i].sprice / app2.currency.coef).toFixed();
                }
                return this.products;
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

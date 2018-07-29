$(document).ready(init);
var app = null;
function init() {
    app = new Vue({
        el: '#app',
        delimiters: ['${', '}'],
        data:{
            price: 0,
            id: 0
        },
        methods:{
            buy: function () {
                $.post('/ajax/addToCart', {'id': this.id}, function (response) {
                    if(response !== null){
                        if(response['ok'] === true){}
                    }
                });
            },
            addToCompareList: function () {
                app2.addToCompareList(this.id);
            }
        },
        computed:{
            priceC: function () {
                return (this.price / app2.currency.coef).toFixed(0);
            }
        }
    });
    fill();
}
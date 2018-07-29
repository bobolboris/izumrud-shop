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
        computed:{
            sum: function () {
                return (this.sumS / app2.currency.coef).toFixed();
            }
        }
    });
    fill();
    onCurrencyChanged = function (newv, oldv) {}
}

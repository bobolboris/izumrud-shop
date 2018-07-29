$(document).ready(init);

var app = null;
function init() {
    app = new Vue({
        el: '#app',
        delimiters: ['${', '}'],
        data:{
            products: [],
            values: []
        },
        computed:{

        },
        methods:{
            remove: function (index) {
                let _this = this;
                $.post('/ajax/removeFromCompare', { 'id': this.products[index].id }, function (response) {
                    if(response !== null){
                        if(response['ok'] === true){
                            _this.products.splice(index, 1);
                            for(let i = 0; i < _this.values.length; i++){
                                _this.values[i].values.splice(index, 1);
                            }
                        }
                    }
                });
            }
        }
    });
    fill();
    onCurrencyChanged = function (newv, oldv) {}
}


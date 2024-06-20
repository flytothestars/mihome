import axios from 'axios';

export default (props) => ({
    cart: [],
    added: false,
    errorCheck: false,
    errorsData: [],
    form: {
        region: 0,
        delivery: '',
        email: '',
        first_name: '',
        last_name: '',
        address_1: '',
        city: '',
        text: '',
        sum: 0,
    },
    tempItem: '',
    regions: [{
        'id': 1,
        'name': 'Алматы',
        'payment_types': [4, 10, 15, 1],
        'deliveries': [
            1, 2, 3, 7
        ],
    },
    {
        'id': 2,
        'name': 'Другие города РК',
        'payment_types': [4, 10, 15],
        'deliveries': [
            8, 9
        ],
    }],
    payment_types: [
        {
            'id': 4,
            'name': 'Счет на компанию',
            'description': 'Укажите ваши реквизиты в разделе Комментарии к заказу.'
        },
        {
            'id': 10,
            'name': 'Kaspi QR',
            'description': 'Возможность рассрочки или кредита.'
        },
        {
            'id': 15,
            'name': 'Банковской картой онлайн',
            'description': 'Скидка 10%.',
        },
        {
            'id': 1,
            'name': 'Наличными при получении',
            'description': ''
        },
    ],
    deliveries: [
        {
            'id': 8,
            'name': 'Авиа экспресс',
            'description': ' (1 - 5 дней) ТК Алем ТАТ - доставка до двери',
            'cost': ''
        },
        {
            'id': 9,
            'name': 'Стандарт',
            'description': ' (5 - 10 дней) ТК Алем ТАТ - доставка до двери',
            'cost': ''
        },
        {
            'id': 1,
            'name': 'Самовывоз',
            'description': ' (В день заказа) Из нашего магазина',
            'cost': ''
        },
        {
            'id': 2,
            'name': 'Центр города',
            'description': '24 часа. Квадрат улиц: Момышулы - Райымбека - Калдаякова - Аль-Фараби.',
            'cost': ''
        },
        {
            'id': 3,
            'name': 'Удаленные районы',
            'description': ' (24 часа) Доставка платная',
            'cost': ''
        },
        {
            'id': 7,
            'name': 'Яндекс Go',
            'description': '3 часа. С 10:00 до 19:00.',
            'cost': ''
        }
    ],
    addItem(item) {
        console.log(item)
        this.tempItem = item;
        this.cart = JSON.parse(localStorage.getItem('cart'));
        this.cart = this.cart || [];
        console.log(this.cart.filter((element) => element.id == item.id))
        if (this.cart.filter((element) => element.id == item.id).length == 1) {
            this.cart.forEach(element => {
                if (element.id === item.id) {
                    element.count = element.count + 1; // new price
                }
            });
            this.saveCatalog();
        } else {
            console.log('test2')
            item.count = 1;
            this.cart.push(item);
            this.saveCatalog();
        }
        this.added = true
    },
    deleteItem(item) {
        console.log(item)
        this.tempItem = item;
        this.cart = JSON.parse(localStorage.getItem('cart'));
        this.cart = this.cart.filter((element) => element.id != item.id)
        this.saveCatalog();
    },
    getCartSum() {
        this.form.sum = 0
        this.cart.forEach(product => {
            this.form.sum += product.count * product.price;
        });
        return this.form.sum
    },
    updateItem(item) {
        console.log(item)
        this.tempItem = item;
        this.cart = JSON.parse(localStorage.getItem('cart'));
        this.cart = this.cart || [];
        if (this.cart.filter((element) => element.id == item.id).length == 1) {
            this.cart.forEach(element => {
                if (element.id === item.id) {
                    element.count = item.count
                }
            });
            this.saveCatalog();
        }
    },
    saveCatalog() {
        this.getCartSum();
        localStorage.setItem('cart', JSON.stringify(this.cart));
    },
    changeRegion($event) {
        console.log($event)
    },
    selectRegion(delivery, region) {
        let reg = JSON.parse(JSON.stringify(this.regions.filter(item => item.id == region)[0].deliveries))
        if (reg.includes(delivery.id)) {
            return true
        } else {
            return false
        }
    },
    selectPayment(payment, region) {
        console.log(region)
        let reg = JSON.parse(JSON.stringify(this.regions.filter(item => item.id == region)[0].payment_types))
        if (reg.includes(payment.id)) {
            return true
        } else {
            return false
        }
    },
    submitOrder() {
        this.errorCheck = false;
        this.errorsData = [];
        axios.post('/cart/create-order', {
            'form': this.form,
            'cart': this.cart
        }).then(response => {
            // window.location.href = '/cart';
            // console.log(response)
        }).catch(error => {
            console.log(error);
            this.errorCheck = true;
            this.errorsData = error.response.data
            setTimeout(function () {
                this.errorCheck = false;
            }, 500)
        })
    },
    init() {
        this.cart = JSON.parse(localStorage.getItem('cart'));
        this.cart = this.cart || [];
    },

})
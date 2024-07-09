export default (minprice, maxprice, filter = {}) => ({
    minprice: filter.minprice ? filter.minprice : minprice,
    maxprice: filter.maxprice ? filter.maxprice : maxprice,
    min: minprice,
    max: maxprice,
    minthumb: 0,
    maxthumb: 0,
    timeout: 0,
    filterOpened: false,

    formatNumber(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ') + " ₸";
    },

    mintrigger() {
        this.minprice = Math.min(this.minprice, this.maxprice - 500);
        this.minthumb = ((this.minprice - this.min) / (this.max - this.min)) * 100;
    },

    maxtrigger() {
        this.maxprice = Math.max(this.maxprice, this.minprice + 500);
        this.maxthumb = 100 - (((this.maxprice - this.min) / (this.max - this.min)) * 100);
    },

    applyFilter() {
        clearTimeout(this.timeout)

        let that = this;
        this.timeout = setTimeout(() => {
            let formData = new FormData(this.$refs.filterform)
            let quertString = this.$refs.filterform.action;
            for (var pr of window.properties) {
                let formPropValues = formData.getAll(pr.slug + '[]');
                if (formPropValues.length) {
                    quertString += encodeURI(`/${formPropValues.join('_or_')}`)
                }
            }
            if ((that.minprice && that.min < that.minprice) || that.minprice && that.max > that.maxprice) {
                quertString += '?';
                if (that.minprice && that.min < that.minprice) quertString += '&minprice=' + that.minprice;
                if (that.minprice && that.max > that.maxprice) quertString += '&maxprice=' + that.maxprice;
            }
            location.href = quertString.indexOf('/filter/') > -1 ? quertString : quertString.replace('/filter', '')
        }, 1250)
    },

    init() {
        let that = this;
        this.$watch('minprice', function (value) {
            that.applyFilter()
        })
        this.$watch('maxprice', function (value) {
            that.applyFilter()
        })
    }
})

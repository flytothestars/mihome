import axios from "axios";

export default (props) => ({
    query: '',
    timeout: null,
    searchObj: null,
    category: null,
    init() {
        let that = this;
        that.$watch('query', function (value) {
            if (value.length > 2) {
                clearTimeout(that.timeout)
                that.timeout = setTimeout(async function () {
                    let { data } = await axios.get('/autocomplete', {
                        params: {
                            q: value
                        }
                    })
                    that.searchObj = data
                }, 500)
            }
        })
        that.$watch('searching', function (value) {
            if (!value) {
                that.searchObj = null
                that.bodycover = !!that.catalogShow
                that.$refs.inputsearch.blur()
            } else {
                that.bodycover = true
                console.log(1)
                setTimeout(function () {
                    that.$refs.inputsearch.focus()
                }, 100)
            }
        })
        that.$watch('catalogShow', function (value) {
            if (!value) {
                that.searchObj = null
                that.bodycover = !!that.searching
            } else {
                that.bodycover = true
            }
        })
        that.$watch('searchObj', function (value) {
            console.log(value)
        })
    }
})

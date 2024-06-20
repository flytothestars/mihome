import moment from 'moment'

export default (props) => ({

    ptypes: props,
    ptype: null,
    moment: moment,

    init() {
        console.log(this.ptypes)

    }
})

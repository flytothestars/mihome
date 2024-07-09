import Swiper from 'swiper/bundle';
import Dropzone from "dropzone";
import axios from 'axios';
import moment from 'moment';


export default (props) => ({
  photoSwiper: null,
  thumbSwiper: null,
  activeTab: 0,
  offer: null,
  dropzone: null,
  productId: props,

  moment: moment,

  files: [],

  reviews: null,

  loadReviews() {
    var that = this;
    axios.get('/reviews', {
      params: {
        product: this.productId,
        page: that.reviews && that.reviews.meta ? that.reviews.meta.current_page + 1 : 1,
      },
    })
      .then(response => {
        if (!that.reviews) {
          that.reviews = response.data
        } else {
          that.reviews.data = that.reviews.data.concat(response.data.data)
          that.reviews.meta = that.response.data.meta;
          that.reviews.links = that.response.data.links;
        }
      })
  },

  init() {
    var that = this;

    this.loadReviews(this.productId);

    if (this.$refs.dropzoneArea) {
      this.dropzone = new Dropzone(this.$refs.dropzoneArea, {
        url: "/reviews/files",
        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': document.getElementsByName('csrf-token')[0].getAttribute('content')
        },
        maxFilesize: 5, // MB
        // accept: function(file, done) {
        //   if (file.name == "justinbieber.jpg") {
        //     done("Naha, you don't.");
        //   }
        //   else { done(); }
        // },
        dictDefaultMessage
          : "Перетащите файлы для загрузки в это поле",
        dictFallbackMessage
          : "К сожалению, ваш браузер не поддерживает Drag'n'Drop",
        dictFallbackText
          : "Пожалуйста, воспользуйтесь старой доброй формой для загрузки",
        dictFileTooBig
          : "Файл слишком большой({{filesize}}MB). Максимальный допустимый размер файла {{maxFilesize}}MB",
        dictInvalidFileType
          : "Вы не можете загружать файлы этого типа.",
        dictResponseError
          : "Произошла ошибка при загрузке файла. Попробуйте еще раз. Если ошибка будет повторяться - передайте эту информацию администратору сайта: Код ошибки {{statusCode}}",
        dictCancelUpload
          : "Отменить загрузку",
        dictCancelUploadConfirmation
          : "Уверены, что хотите прервать загрузку?",
        dictRemoveFile
          : "Удалить файл",
        dictRemoveFileConfirmation
          : null,
        dictMaxFilesExceeded
          : "Превышен лимит количества файлов. Вы можете загрузить не более {{maxFiles}} ",
      })

      this.dropzone.on("success", (file) => {
        that.files = that.dropzone.getAcceptedFiles().map(file => file)
      });

      this.dropzone.on("removedfile", (file) => {
        that.files = that.dropzone.getAcceptedFiles().map(file => file)
        axios.patch('/reviews/files/delete', {
          file: file.name
        })
      });
    }

    that.$watch('offer', (value) => {
      console.log(value)
    })

    // that.thumbSwiper = new Swiper(that.$refs.thumbs, {
    //   direction: window.innerWidth < 640 ? "vertical" : "horizontal",
    //   slidesPerView: 4,
    //   spaceBetween: 4,
    //   loop: that,
    // });

    that.photoSwiper = new Swiper(that.$refs.slider, {
      slidesPerView: 1,
      loop: true,
      autoplay: {
        delay: 5000,
      },
      // thumbs: {
      //   swiper: that.thumbSwiper,
      // },
      navigation: {
        nextEl: '.swiper-next',
        prevEl: '.swiper-prev',
      },
    });
  }
})

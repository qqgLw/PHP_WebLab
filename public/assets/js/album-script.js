const PhotoAlbum = {
  data() {
    return {
      index: -1,
      photos: [
        {
          title: "Фотография #1",
          photo:
            "https://picsum.photos/id/10/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #2",
          photo:
            "https://picsum.photos/id/20/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #3",
          photo:
            "https://picsum.photos/id/30/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #4",
          photo:
            "https://picsum.photos/id/40/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #5",
          photo:
            "https://picsum.photos/id/50/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #6",
          photo:
            "https://picsum.photos/id/60/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #7",
          photo:
            "https://picsum.photos/id/506/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #8",
          photo:
            "https://picsum.photos/id/70/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #9",
          photo:
            "https://picsum.photos/id/80/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #10",
          photo:
            "https://picsum.photos/id/90/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #11",
          photo:
            "https://picsum.photos/id/100/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #12",
          photo:
            "https://picsum.photos/id/110/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #13",
          photo:
            "https://picsum.photos/id/120/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #14",
          photo:
            "https://picsum.photos/id/130/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        },
        {
          title: "Фотография #15",
          photo:
            "https://picsum.photos/id/140/500/500",
          alt: "Альтернативный текст",
          comment: "Коментарий к фотографии"
        }
      ]
    };
  }
};

const app = Vue.createApp(PhotoAlbum);

app.component("album-item", {
  props: ["package"],
  emits: ["click"],
  template: `
        <span class="album-item" @click="$emit('click')">
            <img :src="package.photo" :alt="package.alt">
        </span>
    `,
  data() {
    return {
      isOpened: false
    };
  }
});

app.component("img-popup", {
  props: ["photos", "index"],
  emits: ["close"],
  template: `
        <teleport to="body">
        <div class="img_popup" @click.self="$emit('close')">
            <button type="button" class="to_left" @click="previous">&#8249;</button>
            <div class="content">
                <img :src="photos[id].photo" :alt="photos.alt">
                <div class="text">
                    <h2>{{photos[id].title}}</h2>
                    <p>{{photos[id].comment}}</p>
                </div>
            </div>
            <button type="button" class="to_right" @click="next">&#8250;</button>
        </div>
    </teleport>
    `,
  data() {
    return {
      id: this.$props.index
    };
  },
  methods: {
    previous: function () {
      if (!this.id) {
        this.id = this.$props.photos.length - 1;
      } else {
        this.id--;
      }
    },
    next: function () {
      if (this.id === this.$props.photos.length - 1) {
        this.id = 0;
      } else {
        this.id++;
      }
    }
  }
});

app.mount("#app");
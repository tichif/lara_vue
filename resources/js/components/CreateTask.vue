<template>
  <div>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary my-3"
      data-toggle="modal"
      data-target="#exampleModal"
    >Ajouter une tache</button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter une tache</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <label for="name">Nom de la tache</label>
              <textarea
                name="name"
                placeholder="Nom de la tache"
                v-model="name"
                class="form-control"
              ></textarea>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button
              type="submit"
              class="btn btn-primary"
              :disabled="isValid"
              @click.prevent="storeTask"
              data-dismiss="modal"
            >Ajouter</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: ""
    };
  },
  methods: {
    storeTask() {
      axios
        .post("/tasksList", {
          name: this.name
        })
        .then(({ data }) => {
          this.name = "";
          console.log(data.message);
          this.$emit("createdTask", data.tasks);
        })
        .catch(err => console.log(err));
    }
  },
  computed: {
    isValid() {
      return this.name.length < 5;
    }
  }
};
</script>

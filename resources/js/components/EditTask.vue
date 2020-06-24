<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="editModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="editModal"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModal">Modifier une tache</h5>
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
                v-model="task.name"
                class="form-control"
              ></textarea>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button
              type="submit"
              class="btn btn-primary"
              @click.prevent="editTask"
              data-dismiss="modal"
            >Modifier</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  methods: {
    editTask() {
      axios
        .patch(`/tasksList/${this.task.id}`, {
          name: this.task.name
        })
        .then(({ data }) => {
          console.log(data.message);
          this.$emit("tasks", data.tasks);
        })
        .catch(err => console.log(err));
    }
  }
};
</script>
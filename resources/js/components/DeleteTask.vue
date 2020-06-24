<template>
  <div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="deleteModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="deleteModal"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModal">Supprimer une tache</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Etes vous sur de vouloir supprimer {{ task.name }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button
              type="submit"
              class="btn btn-primary"
              @click.prevent="deleteTask"
              data-dismiss="modal"
            >Oui</button>
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
    deleteTask() {
      axios
        .delete(`/tasksList/${this.task.id}`)
        .then(({ data }) => {
          console.log(data.message);
          this.$emit("taskDeleted", data.tasks);
        })
        .catch(err => console.log(err));
    }
  }
};
</script>
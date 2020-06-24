<template>
  <div class="container">
    <div class="form-row">
      <div class="row-col">
        <input
          type="text"
          class="form-control"
          @keyup="searchTask"
          v-model="search"
          placeholder="Rechercher une tache..."
        />
      </div>
    </div>
    <create-task @createdTask="refresh"></create-task>
    <ul class="list-group">
      <li
        class="list-group-item d-flex justify-content-between align-items-center"
        v-for="task in tasks.data"
        :key="task.id"
      >
        <a href="#">{{ task.name }}</a>
        <div>
          <button
            type="button"
            class="btn btn-secondary my-3"
            data-toggle="modal"
            data-target="#editModal"
            @click.prevent="getTask(task.id)"
          >Editer une tache</button>
          <button
            type="button"
            class="btn btn-danger my-3"
            data-toggle="modal"
            data-target="#deleteModal"
            @click.prevent="getTask(task.id)"
          >Supprimer une tache</button>
        </div>
      </li>
      <edit-task :task="task" @tasks="refresh"></edit-task>
      <delete-task :task="task" @taskDeleted="refresh"></delete-task>
    </ul>
    <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
  </div>
</template>

<script>
import CreateTask from "./CreateTask";
import EditTask from "./EditTask";
import DeleteTask from "./DeleteTask";
export default {
  created() {
    axios
      .get("/tasksList")
      .then(({ data }) => {
        this.tasks = data.tasks;
      })
      .catch(err => console.log(err));
  },
  data() {
    return {
      tasks: {},
      task: {},
      search: ""
    };
  },
  components: { CreateTask, EditTask, DeleteTask },
  methods: {
    getResults(page = 1) {
      axios
        .get("/tasksList?page=" + page)
        .then(({ data }) => {
          this.tasks = data.tasks;
        })
        .catch(err => console.log(err));
    },
    refresh(tasks) {
      this.tasks = tasks;
    },
    getTask(id) {
      axios
        .get(`/tasksList/${id}`)
        .then(({ data }) => {
          this.task = data.task;
        })
        .catch(err => console.log(err));
    },
    searchTask() {
      if (this.search.length > 0) {
        axios
          .get(`/tasksList/${this.search}`)
          .then(({ data }) => {
            this.tasks = data.tasks;
          })
          .catch(err => console.log(err));
      } else {
        axios
          .get("/tasksList")
          .then(({ data }) => {
            this.tasks = data.tasks;
          })
          .catch(err => console.log(err));
      }
    }
  }
};
</script>

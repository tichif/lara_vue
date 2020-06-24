<template>
  <div class="container">
    <create-task @createdTask="refresh"></create-task>
    <ul class="list-group">
      <li
        class="list-group-item d-flex justify-content-between align-items-center"
        v-for="task in tasks.data"
        :key="task.id"
      >
        <a href="#">{{ task.name }}</a>
        <button
          type="button"
          class="btn btn-secondary my-3"
          data-toggle="modal"
          data-target="#editModal"
          @click.prevent="getTask(task.id)"
        >Editer un tache</button>
      </li>
      <edit-task :task="taskToEdit" @tasks="refresh"></edit-task>
    </ul>
    <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
  </div>
</template>

<script>
import CreateTask from "./CreateTask";
import EditTask from "./EditTask";
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
      taskToEdit: {}
    };
  },
  components: { CreateTask, EditTask },
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
          this.taskToEdit = data.task;
        })
        .catch(err => console.log(err));
    }
  }
};
</script>

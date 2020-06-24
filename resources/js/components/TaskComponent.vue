<template>
  <div class="container">
    <create-task @createdTask="createdTask"></create-task>
    <ul class="list-group">
      <li class="list-group-item" v-for="task in tasks.data" :key="task.id">
        <a href="#">{{ task.name }}</a>
      </li>
    </ul>
    <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
  </div>
</template>

<script>
import CreateTask from "./CreateTask";
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
      tasks: {}
    };
  },
  components: { CreateTask },
  methods: {
    getResults(page = 1) {
      axios
        .get("/tasksList?page=" + page)
        .then(({ data }) => {
          this.tasks = data.tasks;
        })
        .catch(err => console.log(err));
    },
    createdTask(tasks) {
      this.tasks = tasks;
    }
  }
};
</script>

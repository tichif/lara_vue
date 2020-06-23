<template>
  <div class="container">
    <ul class="list-group">
      <li class="list-group-item" v-for="task in tasks" :key="task.id">
        <a href="#">{{ task.name }}</a>
      </li>
    </ul>
  </div>
</template>

<script>
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
      tasks: []
    };
  }
};
</script>

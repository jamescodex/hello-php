<template>
  <div class="card">
    <div class="card-header">Departments</div>
    <div class="card-body">
      <div v-if="error && error" class="alert alert-danger" role="alert">{{ error }}</div>

      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Location</th>
              <th scope="col">Phone</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="department in departments" :key="department.id">
              <td>{{ department.id }}</td>
              <td>{{ department.name }}</td>
              <td>{{ department.phone }}</td>
              <td>{{ department.location }}</td>
            </tr>

            <tr v-if="departments && !departments">
              <th colspan="5" class="text-center">No Users</th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      departments: null,
      loading: false,
      error: null,
      success: false
    };
  },

  mounted() {
    const loadUser = async () => {
      try {
        this.loading = true;
        const data = await axios.get("/api/staff/departments");
        this.loading = false;
        const departments = data.data.data;

        this.departments = departments;
      } catch (err) {
        this.loading = false;
        // Check for 500 error status
        if (err.response.status === 500) {
          this.error = "Something went wrong, try again";
          setTimeout(() => {
            this.error = null;
          }, 3000);
        }

        // Set error to state
        const error = err.response.data.error;
        this.error = error;
        setTimeout(() => {
          this.error = null;
        }, 3000);
      }
    };

    loadUser();
  }
};
</script>

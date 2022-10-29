<template>
  <div class="card">
    <div class="card-header">All Staffs</div>
    <div class="card-body">
      <div v-if="success && success" class="alert alert-success" role="alert">{{ success }}</div>

      <div v-if="error && error" class="alert alert-danger" role="alert">{{ error }}</div>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Fistname</th>
              <th scope="col">Lastname</th>
              <th scope="col">Email address</th>
              <th scope="col">Deactivate</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="staff in staffs" :key="staff.id">
              <td>{{ staff.id }}</td>
              <td>{{ staff.firstname }}</td>
              <td>{{ staff.lastname }}</td>
              <td>{{ staff.email }}</td>
              <td>
                <a href="#!" class="btn btn-danger" @click="deactivate(staff.id)">Deactivate</a>
              </td>
            </tr>

            <tr v-if="staffs && !staffs">
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
      staffs: null,
      loading: false,
      error: null,
      success: false
    };
  },
  mounted() {
    const loadStaffs = async () => {
      try {
        this.loading = true;
        const data = await axios.get("/api/admin/staffs");
        this.loading = false;

        const staffs = data.data.data;

        this.staffs = staffs;
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

    loadStaffs();
  },

  methods: {
    async deactivate(id) {
      try {
        axios.get(`/api/admin/staff/deactivate/${id}`);
        this.success = "Staff deativated successfully";
        window.location.reload();
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
    }
  }
};
</script>

<template>
  <div class="card">
    <div class="card-header">Create Department</div>
    <div class="card-body">
      <div v-if="success && success" class="alert alert-success" role="alert">{{ success }}</div>

      <div v-if="error && error" class="alert alert-danger" role="alert">{{ error.name[0] }}</div>

      <form @submit.prevent="createDepartment">
        <div class="form-group">
          <label for="name">Name</label>
          <input
            type="text"
            name="name"
            id="name"
            v-model="department.name"
            required
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="name">Location</label>
          <input
            type="text"
            name="location"
            id="location"
            v-model="department.location"
            class="form-control"
          />
        </div>
        <div class="form-group">
          <label for="name">Phone number</label>
          <input type="tel" name="phone" id="phone" v-model="department.phone" class="form-control" />
        </div>
        <div class="form-group">
          <label for="name">Select Staff</label>
          <select
            class="form-control"
            name="staff_id"
            id="staff_id"
            v-model="department.staff_id"
            required
          >
            <option
              v-for="staff in staffs"
              :value="staff.id"
              :key="staff.id"
            >{{staff.firstname + "" + staff.lastname}}</option>
          </select>
        </div>

        <div class="form-group">
          <div class="text-center">
            <button class="btn btn-success btn-lg" v-if="loading" disabled>Loading...</button>
            <button class="btn btn-success btn-lg" v-if="!loading">Publish</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      department: {},
      staffs: null,
      loading: false,
      error: null,
      success: false
    };
  },

  mounted() {
    const loadStaffs = async () => {
      try {
        const data = await axios.get("/api/admin/staffs");

        const staffs = data.data.data;

        this.staffs = staffs;
      } catch (err) {
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
    async createDepartment() {
      try {
        this.loading = true;
        const data = await axios.post(
          "/api/admin/create/department",
          this.department
        );
        this.loading = false;
        // Set success response to state
        this.success = "Department created successfully";
        setTimeout(() => {
          this.success = null;
        }, 3000);
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

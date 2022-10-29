<template>
  <div class="card">
    <div class="card-header">User's Information</div>
    <div class="card-body">
      <div v-if="success && success" class="alert alert-success" role="alert">{{ success }}</div>

      <div v-if="error && error" class="alert alert-danger" role="alert">{{ error.email[0] }}</div>

      <form @submit.prevent="createStaff">
        <div class="form-group">
          <label for="name">Firstname</label>
          <input
            type="text"
            name="firstname"
            id="firstname"
            v-model="data.firstname"
            required
            class="form-control"
            placeholder
          />
        </div>
        <div class="form-group">
          <label for="name">Lastname</label>
          <input
            type="text"
            name="lastname"
            id="lastname"
            v-model="data.lastname"
            class="form-control"
            placeholder
          />
        </div>
        <div class="form-group">
          <label for="name">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            v-model="data.email"
            class="form-control"
            placeholder
          />
        </div>

        <div class="form-group">
          <div class="text-center">
            <button class="btn btn-success btn-lg" v-if="loading" disabled>Loading...</button>
            <button class="btn btn-success btn-lg" v-if="!loading">Submit</button>
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
      data: {},
      loading: false,
      error: null,
      success: false
    };
  },

  methods: {
    async createStaff() {
      try {
        this.loading = true;
        await axios.post("/api/admin/create/staff", this.data);
        this.loading = false;
        this.success = "Staff create successfully";
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

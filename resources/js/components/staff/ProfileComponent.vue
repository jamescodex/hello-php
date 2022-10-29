<template>
  <div class="card">
    <div class="card-header">User's Information</div>
    <div class="card-body">
      <div v-if="success && success" class="alert alert-success" role="alert">{{ success }}</div>

      <div v-if="error && error" class="alert alert-danger" role="alert">{{ error }}</div>

      <form @submit.prevent="updateUser">
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

          <span class="invalid-feedback" role="alert">
            <strong v-if="error && error.firstname">
              {{
              error.first[0]
              }}
            </strong>
          </span>
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
          <label for="name">Old Password</label>
          <input
            type="password"
            name="old_password"
            id="old_password"
            v-model="data.old_password"
            class="form-control"
            placeholder
          />
        </div>
        <div class="form-group">
          <label for="name">New Password</label>
          <input
            type="password"
            name="new_password"
            id="new_password"
            v-model="data.new_password"
            class="form-control"
            placeholder
          />
        </div>

        <div class="form-group">
          <div class="text-center">
            <button class="btn btn-success btn-lg" v-if="loading" disabled>Loading...</button>
            <button class="btn btn-success btn-lg" v-if="!loading">Update profile</button>
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
      data: {
        firstname: "",
        lastname: "",
        email: "",
        old_password: null,
        new_password: null
      },
      departments: null,
      loading: false,
      error: null,
      success: false
    };
  },

  mounted() {
    const loadUser = async () => {
      try {
        const data = await axios.get("/api/staff/user");

        const user = data.data.data;

        this.data.firstname = user.firstname;
        this.data.lastname = user.lastname;
        this.data.email = user.email;
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

    loadUser();
  },
  methods: {
    async updateUser() {
      try {
        this.loading = true;
        const data = await axios.post("/api/staff/update", this.data);
        this.loading = false;
        // Set success response to state
        this.success = "Profile updated successfully";
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

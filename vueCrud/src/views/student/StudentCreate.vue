<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header">
        <h4>Add Students</h4>
      </div>

      <div class="card-body">

        <ul class="alert alert-warning" v-if="Object.keys(errorList).length > 0">
            <li class="mb-0 ms-3" v-for="(error,index) in errorList" :key="index">
                    {{ error[0] }}
            </li>
        </ul>
        <div class="mb-3">
          <label for="name">Name</label>
          <input
            type="text"
            v-model="model.student.name"
            class="form-control"
          />
        </div>
        <div class="mb-3">
          <label for="email">Email</label>
          <input
            type="email"
            v-model="model.student.email"
            class="form-control"
          />
        </div>
        <div class="mb-3">
          <label for="phone">Phone</label>
          <input
            type="text"
            v-model="model.student.phone"
            class="form-control"
          />
        </div>
        <div class="mb-3">
          <label for="Course">Course</label>
          <input
            type="text"
            v-model="model.student.course"
            class="form-control"
          />
        </div>
        <div class="mb-3">
          <button
            type="button"
            @click="saveStudent"
            class="btn btn-primary float-end"
          >
            Save
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "studentCreate",
  data() {
    return {
      errorList: {},
      model: {
        student: {
          name: "",
          email: "",
          course: "",
          phone: "",
        },
      },
    };
  },
 
  methods: {

    saveStudent() {
      var mythis = this;
      axios
        .post("http://127.0.0.1:8000/api/students", this.model.student)
        .then((res) => {
          console.log(res);
          alert(res.data.messege);
          this.model.student = {
            name: "",
            email: "",
            course: "",
            phone: "",
            }
          this.errorList = {};
          //   }
        }).catch(function (error) {
            if (error.response && error.response.status === 422) {
            mythis.errorList = error.response.data.errors;
          } else {
            console.log(error.response || error.message || error.config);
          }
            console.log(error.config);
          });
    },
  },
};
</script>

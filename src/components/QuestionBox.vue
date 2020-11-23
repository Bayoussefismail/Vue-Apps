<template >
  <b-jumbotron>
  <template #lead>
    {{currentQuestion.question}}
  </template>
  <hr class="my-4">
  <b-list-group>
 <b-list-group-item
   v-for="(answer, index) in answers"
   :key="index"
   @click.prevent="selectAnswer(index)"
   :class="answerStyle(index)"
   >{{answer}}</b-list-group-item>
 </b-list-group>
  <b-button variant="primary"
    @click="submitAnswer"
    :disabled="selectedIndex === null || answered"
    >
    Submit</b-button>
  <b-button @click="next" variant="success">Next</b-button>
  </b-jumbotron>

</template>

<script>
import _ from 'lodash'

  export default {
    props: {
      currentQuestion: Object,
      next: Function,
      increment: Function
    },
    data() {
      return {
        selectedIndex: null,
        correctIndex: null,
        shuffleAnswers: [],
        answered: false
      }
    },
    computed: {
      answers() {
        let answers = [...this.currentQuestion.incorrect_answers]
        answers.push(this.currentQuestion.correct_answer)
         return answers
      }
    },
    watch: {
      currentQuestion: {
        immediate: true,
        handler() {

          this.selectedIndex = null
          this.answered = false
          this.random()
        }
      }
    },
    methods: {
      selectAnswer(index) {
        this.selectedIndex = index
      },
      random() {
        let answers = [...this.currentQuestion.incorrect_answers, this.currentQuestion.correct_answer]
        this.shuffledAnswers = _.shuffle(answers)
        this.correctIndex = this.shuffledAnswers.indexOf(this.currentQuestion.correct_answer)
      },
      submitAnswer() {
        let isCorrect = false
        if (this.selectedIndex === this.correctIndex) {
          isCorrect= true
        }
        this.answered = true
        this.increment(isCorrect)
      },
      answerStyle(index) {
        let answerStyle = ''
        if (!this.answered && this.selectedIndex === index ) {
          answerStyle = 'selected'
        } else if (this.answered
          &&  this.correctIndex === index) {
          answerStyle = 'correct'
        } else if (this.answered
          && this.selectedIndex === index
          && this.correctIndex !== index ) {
          answerStyle = 'incorrect'
        }
        return answerStyle
 }
    }
  }
</script>
<style scoped>
.list-group {
  margin-bottom: 15px;
}
.list-group-item:hover {
  background: #EEE;
  cursor: pointer;
}
.btn {
  margin: 0 5px;
}
.selected {
  background-color: lightblue;
}
.correct {
  background-color: lightgreen;
  }
.incorrect {
  background-color: #FFCCCB;
}
</style>

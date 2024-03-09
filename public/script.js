let currentQuestionIndex = 0;
var com = 0;
const questions = document.querySelectorAll('.question');

// 显示第一道题目
questions[currentQuestionIndex].style.display = 'block';


function showNextQuestion(currentQuestionId) {
    const currentQuestion = document.getElementById(currentQuestionId);
    const inputs = currentQuestion.querySelectorAll('input[type="radio"]');
    let checked = false;
    inputs.forEach(input => {
        if (input.checked) {
            checked = true;
        }
    });
    if (!checked) {
        alert('请至少选择一个选项！');
        return;
    }

    currentQuestion.style.display = 'none';

    if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        questions[currentQuestionIndex].style.display = 'block';
    } else {
        // 如果已经是最后一道题，则显示提交所有答案的按钮
        com = 1;
        document.querySelector('button[type="submit"]').style.display = 'block';
    }
}

function submitForm() {
    if (com == 1) {
        // 在这里处理表单提交逻辑
        // 返回 true 允许表单继续提交，返回 false 阻止表单的默认提交
        return true;
    } else {
        return false;
    }
}

function selectRadio(divId, radioId) {
    var radio = document.getElementById(radioId);
    var divId = document.getElementById(divId);
    radio.checked = !radio.checked;
    for (var i = 0; i < 3; i++) {
        if (("div" + i) != radioId) {
            var other = document.getElementById("div" + i);
            other.setAttribute('style', 'background-color: rgba(255, 255, 255, 1);');
        }
    }
    divId.setAttribute('style', 'background-color: rgba(227, 235, 250, 1);');
}
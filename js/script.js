$().ready(function () {

    if (document.querySelector('.index-page')) {
        const message = document.querySelector('.message');
        const form = document.querySelector('.form-inline');
        $('#loginform').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '/subscribe',
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    const jsonData = JSON.parse(response);
                    if (jsonData.subscribe == 1) {
                        form.hidden = jsonData.subscribe;
                    } else {
                        message.textContent = jsonData.message;
                    }
                }
            });
        });
    }

    if (document.querySelector('.profile-page')) {
        const btn = document.querySelector('#submitBtn');
        btn.textContent = btn.dataset.subscribe;
        let i = 1;

        if (btn.textContent == 'Отписка') {
            i += 1;
        }

        function subscribe() {
            $.ajax({
                url: '/subscribe',
                method: "POST",
                data: $('#subscribeProfileForm').serialize(),
                dataType: "JSON",
                timeout: 3000,
            });
        }

        function unsubscribe() {
            $.ajax({
                url: '/subscribe/destroy',
                method: "POST",
                data: $('#subscribeProfileForm').serialize(),
                dataType: "JSON",
                timeout: 3000,
            });
        }

        $("#submitBtn").click(function (evt) {
            evt.preventDefault();

            i++;
            let status = '';
            if (i % 2) {
                status = 'Подписка';
                unsubscribe()
            } else {
                status = 'Отписка';
                subscribe();
            }
            btn.textContent = status;
        });
    }

    if (document.querySelector('.admin-user-roles')) {
        const message = document.querySelector('.message');
        const para = document.createElement("p");

        $('.items-on-page').on('change', function (e) {
            $('.admin-pagination-button').click();
        });

        $('.select-role-id').on('change', function (e) {
            const obj = {
                roleId: this.value,
                userId: $(this).attr("data-id")
            };

            $.ajax({
                url: '/user/role/' + obj.userId + '/edit',
                method: "POST",
                data: obj,
                success: function (response) {
                    $(para).addClass("alert alert-success");
                    const node = document.createTextNode(response);
                    para.textContent = "";
                    para.appendChild(node);
                    message.appendChild(para);
                },
                dataType: "JSON",
                timeout: 3000,
            });
        });
    }

    if (document.querySelector('.admin-comments')) {
        const message = document.querySelector('.message');
        const para = document.createElement("p");

        $('.items-on-page').on('change', function (e) {
            $('.admin-pagination-button').click();
        });

        $('.select-status').on('change', function (e) {
            const obj = {
                status: this.value,
                commentId: $(this).attr("data-id")
            };

            $.ajax({
                url: '/admin/comment/' + obj.commentId + '/edit',
                method: "POST",
                data: obj,
                success: function (response) {
                    $(para).addClass("alert alert-success");
                    const node = document.createTextNode(response);
                    para.textContent = "";
                    para.appendChild(node);
                    message.appendChild(para);
                },
                dataType: "JSON",
                timeout: 3000,
            });
        });
    }

    if (document.querySelector('.admin-subscribes')) {
        $('.items-on-page').on('change', function (e) {
            $('.admin-pagination-button').click();
        });
    }

    if (document.querySelector('.admin-pages')) {
        $('.items-on-page').on('change', function (e) {
            $('.admin-pagination-button').click();
        });
    }
});

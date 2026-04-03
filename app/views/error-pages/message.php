<style>
    .dev-message {
        background-color: #90C1BE;
        margin-top: 2rem;
        padding: 1rem;
    }

    .dev-message .header {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .dev-message .label {
        font-weight: bold;
        margin-top: 1rem;
    }

    .dev-message .content {
        word-wrap: break-word;
        white-space: pre-wrap;
    }
</style>

<div class="dev-message">
    <p class="header">Message for developers:</p>

    <br>
    <p class="content"><?= $exception ?></p>
</div>

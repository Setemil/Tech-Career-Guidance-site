document.addEventListener("DOMContentLoaded", function() {
    // Simulating data fetching from a database
    const stats = {
        totalUsers: 1500,
        jobPosts: 120,
        sessions: 45,
        signups: 80
    };

    document.getElementById("totalUsers").innerText = stats.totalUsers;
    document.getElementById("jobPosts").innerText = stats.jobPosts;
    document.getElementById("sessions").innerText = stats.sessions;
    document.getElementById("signups").innerText = stats.signups;
});
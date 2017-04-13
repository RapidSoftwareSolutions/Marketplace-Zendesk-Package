[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/ZendeskCore/functions?utm_source=RapidAPIGitHub_ZendeskCoreFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# ZendeskCore Package
Capture, curate and manage asynchronous videos/playbacks.
* Domain: [Zendesk](https://zendesk.com)
* Credentials: clientId, clientSecret

## How to get credentials: 
1. clienId you can find it at Admin->Channels->API->OAuth Clients
2. clienSecret value you received when you registered your application with Zendesk
 
## ZendeskCore.getAccessToken
Get AccessToken

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| Unique Identifier. You can find it at Admin->Channels->API->OAuth Clients
| clientSecret| credentials| Secret value you received when you registered your application with Zendesk
| domain      | String     | Your domain in Zendesk system.
| code        | String     | Code you received from Zendesk after the user granted access
| redirectUri | String     | The same redirect URL as in received Code step.

## ZendeskCore.getIncrementalTickets
Returns the tickets that changed since the start time. The results include tickets that were updated by the system. The endpoint can return records where the updated_at time is earlier than the start_date time. The reason is that the updated_at value is updated only if the ticket update generates a ticket event. Otherwise, the timestamp of the previous update carries over.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| startTime  | Number| Unix time. Example: 1491782400

## ZendeskCore.getIncrementalTicketsEvents
Returns a stream of changes that occurred on tickets. Each event is tied to an update on a ticket and contains all the fields that were updated in that change. You can include comments in the event stream by using the comment_events sideload. See Sideloading below. If you don't specify the sideload, any comment present in the ticket update is described only by Boolean comment_present and comment_public object properties in the event's child_events array. The comment itself is not included.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| startTime  | Number| Unix time. Example: 1491782400

## ZendeskCore.getIncrementalOrganizations
Method description

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| startTime  | Number| Unix time. Example: 1491782400

## ZendeskCore.getIncrementalUsers
Method description

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| startTime  | Number| Unix time. Example: 1491782400

## ZendeskCore.getJobStatuses
This shows the current statuses for background jobs running.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.

## ZendeskCore.getSingleJobStatus
Get Job bi ID

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| jobId      | String| Job ID token

## ZendeskCore.getJobStatusesByIds
Get many Job by IDs

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| jobIds     | Array | List of job status ids.

## ZendeskCore.getTickets
Tickets are ordered chronologically by created date, from oldest to newest. The first ticket listed may not be the absolute oldest ticket in your account due to ticket archiving. To get a list of all tickets in your account, use the Incremental Ticket Export endpoint.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| sortBy     | String| Possible values are assignee, assignee.name, created_at, group, id, locale, requester, requester.name, status, subject, updated_at
| sortOrder  | String| One of asc, desc. Defaults to asc

## ZendeskCore.getSingleTicket
Returns a number of ticket properties, but not the ticket comments. To get the comments, use List Comments.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | String| Ticket ID

## ZendeskCore.getTicketsByIds
Accepts a list of ticket ids to return. This endpoint will return up to 100 tickets records.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketIds  | Array | Comma-separated list of ticket ID

## ZendeskCore.createSingleTicket
Create ticket

| Field              | Type  | Description
|--------------------|-------|----------
| accessToken        | String| Access Token
| domain             | String| Your domain in Zendesk system.
| comment            | String| A comment object that describes the problem, incident, question, or task. todo JSON
| subject            | String| The subject of the ticket
| requesterId        | Number| The numeric ID of the user asking for support through the ticket
| submitterId        | Number| The numeric ID of the user submitting the ticket
| assigneeId         | Number| The numeric ID of the agent to assign the ticket to
| groupId            | Number| The numeric ID of the group to assign the ticket to
| collaboratorIds    | Array | An array of the numeric IDs of agents or end-users to CC on the ticket. An email notification is sent to them when the ticket is created
| collaborators      | Array | An array of numeric IDs, emails, or objects containing name and email properties. An email notification is sent to them when the ticket is created. Example: collaborators: [ 562, someone@example.com, { name: Someone Else, email: else@example.com } ]
| type               | String| Allowed values are problem, incident, question, or task
| priority           | String| Allowed values are urgent, high, normal, or low
| status             | String| Allowed values are new, open, pending, hold, solved or closed. Is set to new if status is not specified
| tags               | Array | Comma-separated of tags to add to the ticket
| externalId         | Number| An ID to link Zendesk Support tickets to local records
| forumTopicId       | Number| The numeric ID of the topic the ticket originated from, if any
| problemId          | Number| For tickets of type 'incident', the numeric ID of the problem the incident is linked to, if any
| dueAt              | String| For tickets of type 'task', the due date of the task. Accepts the ISO 8601 date format (yyyy-mm-dd)
| ticketFormId       | Number| (Enterprise only) The id of the ticket form to render for the ticket
| customFields       | Array | An array of the custom fields of the ticket. See below for details
| viaFollowupSourceId| String| The id of a closed ticket for a follow-up ticket.

## ZendeskCore.createTickets
Create many tickets from JSON file

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| tickets    | File  | File contents array of tickets data. Example [{ticketData1}, {ticketData2}]. TicketData the same as when creating one ticket.

## ZendeskCore.updateSingleTicket
Update ticket

| Field              | Type  | Description
|--------------------|-------|----------
| accessToken        | String| Access Token
| domain             | String| Your domain in Zendesk system.
| ticketId           | Number| Ticket ID
| comment            | String| A comment object that describes the problem, incident, question, or task. todo json
| subject            | String| The subject of the ticket
| requesterId        | Number| The numeric ID of the user asking for support through the ticket
| submitterId        | Number| The numeric ID of the user submitting the ticket
| assigneeId         | Number| The numeric ID of the agent to assign the ticket to
| groupId            | Number| The numeric ID of the group to assign the ticket to
| collaboratorIds    | Array | An array of the numeric IDs of agents or end-users to CC on the ticket. An email notification is sent to them when the ticket is created
| collaborators      | Array | An array of numeric IDs, emails, or objects containing name and email properties. An email notification is sent to them when the ticket is created. Example: collaborators: [ 562, someone@example.com, { name: Someone Else, email: else@example.com } ]
| type               | String| Allowed values are problem, incident, question, or task
| priority           | String| Allowed values are urgent, high, normal, or low
| status             | String| Allowed values are new, open, pending, hold, solved or closed. Is set to new if status is not specified
| tags               | Array | Comma-separated of tags to add to the ticket
| externalId         | Number| An ID to link Zendesk Support tickets to local records
| forumTopicId       | Number| The numeric ID of the topic the ticket originated from, if any
| problemId          | Number| For tickets of type 'incident', the numeric ID of the problem the incident is linked to, if any
| dueAt              | String| For tickets of type 'task', the due date of the task. Accepts the ISO 8601 date format (yyyy-mm-dd)
| ticketFormId       | Number| (Enterprise only) The id of the ticket form to render for the ticket
| customFields       | Array | An array of the custom fields of the ticket. See below for details
| viaFollowupSourceId| String| The id of a closed ticket for a follow-up ticket.

## ZendeskCore.markSingleTicketAsSpam
Mark Ticket as Spam and Suspend Requester

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID

## ZendeskCore.markTicketsAsSpam
Mark Tickets as Spam and Suspend Requester

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketIds  | Array | List of Ticket IDs

## ZendeskCore.mergeTickets
Merges one or more tickets into the {id} target ticket.

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Access Token
| domain       | String| Your domain in Zendesk system.
| ticketId     | Number| Ticket ID
| ids          | Array | List of Ticket IDs
| targetComment| String| Private comment to add to the target ticket
| sourceComment| String| Private comment to add to the source ticket

## ZendeskCore.getTicketRelatedInfo
Get ticket related info

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID

## ZendeskCore.deleteSingleTicket
Delete ticket

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID

## ZendeskCore.deleteTickets
Delete tickets

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketIds  | Array | List of ticket ids

## ZendeskCore.getTicketCollaborators
Get collaborators from ticket

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID

## ZendeskCore.getTicketIncidents
Get ticket incidents

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID

## ZendeskCore.getTicketsProblems
Get probles tickets

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.

## ZendeskCore.autocompleteTicketsProblems
Returns tickets whose type is 'Problem' and whose subject contains the string specified in the text parameter.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| text       | String| Search expression

## ZendeskCore.getAttachment
Get attachment data by ID

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access Token
| domain      | String| Your domain in Zendesk system.
| attachmentId| Number| Attachment ID

## ZendeskCore.getComments
Get all comments from ticket

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID
| sortOrder  | String| One of asc, desc. Defaults to asc

## ZendeskCore.removeCommentAttachment
Redaction allows you to permanently remove attachments from an existing comment on a ticket. Once removed from a comment, the attachment is replaced with a placeholder 'redacted.txt' file. Note that redaction is permanent. It is not possible to undo redaction or see what was removed. Once a ticket is closed, redacting its attachments is no longer possible.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access Token
| domain      | String| Your domain in Zendesk system.
| ticketId    | Number| Ticket ID
| commentId   | Number| Comment ID
| attachmentId| Number| Attachment ID

## ZendeskCore.deleteAttachment
Remove attachment

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access Token
| domain      | String| Your domain in Zendesk system.
| attachmentId| Number| Attachment ID

## ZendeskCore.uploadFiles
Adding multiple attachments to the same upload is handled by splitting requests and passing the API token received from the first request to each subsequent request. The token is valid for 3 days. Note: Even if private attachments are enabled in the Zendesk Support instance, uploaded files are visible to any authenticated user at the content_URL specified in the JSON response until the upload token is consumed. Once an attachment is associated with a ticket or post, visibility is restricted to users with access to the ticket or post with the attachment.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| file       | File  | File
| fileName   | String| File name
| uploadToken| String| Upload token. Use it when need to upload more then 1 file and associate with token

## ZendeskCore.deleteUpload
Delete upload with all attachments

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| uploadToken| String| Upload token. Use it when need to upload more then 1 file and associate with token

## ZendeskCore.getSatisfactionRatings
List all received satisfaction rating requests ever issued for your account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.

## ZendeskCore.createSatisfactionRating
Create a rating for solved tickets, or for tickets that were previously solved and then reopened.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID
| sortOrder  | String| One of asc, desc. Defaults to asc

## ZendeskCore.getSuspendedTickets
Get all suspended tickets

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.

## ZendeskCore.getTicketAudits
Lists the audits for a specified ticket.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID

## ZendeskCore.getTicketSingleAudits
Get audit for a specified ticket by audit ID

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID
| auditId    | Number| Audit ID

## ZendeskCore.makeAuditPrivate
Hide audit by ID

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID
| auditId    | Number| Audit ID

## ZendeskCore.removeWordFromTicketComment
Permanently removes words or strings from a ticket comment. Specify the string to redact in an object with a text property. Example: {"text": "credit-card-number"}. The characters of the word or string are replaced by the ▇ symbol. Redaction is permanent. You can't undo the redaction or see what was removed. Once a ticket is closed, you can no longer redact strings from its comments.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID
| commentId  | Number| Comment ID
| text       | String| Text to search

## ZendeskCore.makeCommentPrivate
Make comment private

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID
| commentId  | Number| Comment ID

## ZendeskCore.getSkippedTickets
Get all skipped tickets

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access Token
| domain     | String| Your domain in Zendesk system.


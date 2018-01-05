[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/ZendeskCore/functions?utm_source=RapidAPIGitHub_ZendeskCoreFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# ZendeskCore Package
Capture, curate and manage asynchronous videos/playbacks.
* Domain: [Zendesk](https://zendesk.com)
* Credentials: apiToken

## How to get credentials: 
1. Navigate to Zendesk Support Admin interface at Admin > Channels > API.
2. The page lets you view, add, or delete tokens.
 
## ZendeskCore.getIncrementalTickets
Returns the tickets that changed since the start time. The results include tickets that were updated by the system. The endpoint can return records where the updated_at time is earlier than the start_date time. The reason is that the updated_at value is updated only if the ticket update generates a ticket event. Otherwise, the timestamp of the previous update carries over.

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| startTime| Number| Unix time. Example: 1491782400

## ZendeskCore.getIncrementalTicketsEvents
Returns a stream of changes that occurred on tickets. Each event is tied to an update on a ticket and contains all the fields that were updated in that change. You can include comments in the event stream by using the comment_events sideload. See Sideloading below. If you don't specify the sideload, any comment present in the ticket update is described only by Boolean comment_present and comment_public object properties in the event's child_events array. The comment itself is not included.

| Field    | Type      | Description
|----------|-----------|----------
| apiToken | String    | Access Token
| email    | String    | Your e-mail in Zendesk system.
| domain   | String    | Your domain in Zendesk system.
| startTime| DatePicker| Unix time. Example: 1491782400

## ZendeskCore.getIncrementalOrganizations
Returns the organizations that changed since the start time.

| Field    | Type      | Description
|----------|-----------|----------
| apiToken | String    | Access Token
| email    | String    | Your e-mail in Zendesk system.
| domain   | String    | Your domain in Zendesk system.
| startTime| DatePicker| Unix time. Example: 1491782400

## ZendeskCore.getIncrementalUsers
Returns the users that changed since the start time.

| Field    | Type      | Description
|----------|-----------|----------
| apiToken | String    | Access Token
| email    | String    | Your e-mail in Zendesk system.
| domain   | String    | Your domain in Zendesk system.
| startTime| DatePicker| Unix time. Example: 1491782400

## ZendeskCore.getJobStatuses
This shows the current statuses for background jobs running.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleJobStatus
Get Single Job Status

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| jobId   | String| Job ID token

## ZendeskCore.getJobStatusesByIds
Get many Job by IDs

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| jobIds  | List  | List of job status ids.

## ZendeskCore.getTickets
Tickets are ordered chronologically by created date, from oldest to newest. The first ticket listed may not be the absolute oldest ticket in your account due to ticket archiving. To get a list of all tickets in your account, use the Incremental Ticket Export endpoint.

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| sortBy   | Select| Possible values are assignee, assignee.name, created_at, group, id, locale, requester, requester.name, status, subject, updated_at
| sortOrder| Select| One of asc, desc. Defaults to asc

## ZendeskCore.getSingleTicket
Returns a number of ticket properties, but not the ticket comments. To get the comments, use List Comments.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| String| Ticket ID

## ZendeskCore.getTicketsByIds
Accepts a list of ticket ids to return. This endpoint will return up to 100 tickets records.

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| ticketIds| List  | List of ticket ID

## ZendeskCore.createSingleTicket
Create ticket

| Field              | Type      | Description
|--------------------|-----------|----------
| apiToken           | String    | Access Token
| email              | String    | Your e-mail in Zendesk system.
| domain             | String    | Your domain in Zendesk system.
| comment            | String    | A comment object that describes the problem, incident, question, or task. todo JSON
| subject            | String    | The subject of the ticket
| requesterId        | Number    | The numeric ID of the user asking for support through the ticket
| submitterId        | Number    | The numeric ID of the user submitting the ticket
| assigneeId         | Number    | The numeric ID of the agent to assign the ticket to
| groupId            | Number    | The numeric ID of the group to assign the ticket to
| collaboratorIds    | List      | An array of the numeric IDs of agents or end-users to CC on the ticket. An email notification is sent to them when the ticket is created
| collaborators      | JSON      | An array of numeric IDs, emails, or objects containing name and email properties. An email notification is sent to them when the ticket is created. Example: collaborators: [ 562, someone@example.com, { name: Someone Else, email: else@example.com } ]
| type               | Select    | Allowed values are problem, incident, question, or task
| priority           | Select    | Allowed values are urgent, high, normal, or low
| status             | Select    | Allowed values are new, open, pending, solved or closed. Is set to new if status is not specified
| tags               | List      | List of tags to add to the ticket
| externalId         | Number    | An ID to link Zendesk Support tickets to local records
| forumTopicId       | Number    | The numeric ID of the topic the ticket originated from, if any
| problemId          | Number    | For tickets of type 'incident', the numeric ID of the problem the incident is linked to, if any
| dueAt              | DatePicker| For tickets of type 'task', the due date of the task. Accepts the ISO 8601 date format (yyyy-mm-dd)
| ticketFormId       | Number    | (Enterprise only) The id of the ticket form to render for the ticket
| customFields       | JSON      | An array of the custom fields of the ticket. See below for details
| viaFollowupSourceId| String    | The id of a closed ticket for a follow-up ticket.

## ZendeskCore.createTickets
Create many tickets from JSON file

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| tickets | List  | JSON contents array of tickets data. Example [{ticketData1}, {ticketData2}]. TicketData the same as when creating one ticket.

## ZendeskCore.updateSingleTicket
Update single ticket

| Field          | Type      | Description
|----------------|-----------|----------
| apiToken       | String    | Access Token
| email          | String    | Your e-mail in Zendesk system.
| domain         | String    | Your domain in Zendesk system.
| ticketId       | Number    | Ticket ID
| commentBody    | String    | Comment
| commentHtmlBody| String    | HTML code of comment
| commentAuthorId| Number    | Author ID of comment
| commentShow    | Boolean   | False - make comment private
| externalId     | String    | An id you can use to link Zendesk Support tickets to local records
| type           | Select    | The type of this ticket, i.e. "problem", "incident", "question" or "task"
| subject        | String    | The value of the subject field for this ticket
| rawSubject     | String    | The dynamic content placeholder, if present, or the "subject" value, if not. See Dynamic Content
| priority       | Select    | Priority, defines the urgency with which the ticket should be addressed: "urgent", "high", "normal", "low"
| status         | Select    | The state of the ticket, "new", "open", "pending", "hold", "solved", "closed"
| recipient      | String    | The original recipient e-mail address of the ticket
| requesterId    | Number    | The user who requested this ticket
| submitterId    | Number    | The user who submitted the ticket; The submitter always becomes the author of the first comment on the ticket.
| assigneeId     | Number    | What agent is currently assigned to the ticket
| organizationId | Number    | The organization of the requester. You can only specify the ID of an organization associated with the requester. See Organization Memberships
| groupId        | Number    | The group this ticket is assigned to
| collaboratorIds| JSON      | Who are currently CC'ed on the ticket
| forumTopicId   | Number    | The topic this ticket originated from, if any
| problemId      | Number    | The problem this incident is linked to, if any
| dueAt          | DatePicker| If this is a ticket of type "task" it has a due date. Due date format uses ISO 8601 format.
| tags           | List      | The array of tags applied to this ticket
| customFields   | JSON      | The custom fields of the ticket
| ticketFormId   | Number    | The id of the ticket form to render for this ticket - only applicable for enterprise accounts
| brandId        | Number    | The id of the brand this ticket is associated with - only applicable for enterprise accounts

## ZendeskCore.updateTickets
Update tickets by its id (in each obj in list)

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| params  | List  | Json file with params to update. Example [param1, param2]. Each param is object like params in updateSingleTicket

## ZendeskCore.updateTicketsByIds
Update many tickets with the same information

| Field          | Type      | Description
|----------------|-----------|----------
| apiToken       | String    | Access Token
| email          | String    | Your e-mail in Zendesk system.
| domain         | String    | Your domain in Zendesk system.
| ticketIds      | List      | List of ticket ids
| commentBody    | String    | Comment
| commentHtmlBody| String    | HTML code of comment
| commentAuthorId| Number    | Author ID of comment
| commentShow    | Boolean   | False - make comment private
| externalId     | String    | An id you can use to link Zendesk Support tickets to local records
| type           | Select    | The type of this ticket, i.e. "problem", "incident", "question" or "task"
| subject        | String    | The value of the subject field for this ticket
| rawSubject     | String    | The dynamic content placeholder, if present, or the "subject" value, if not. See Dynamic Content
| priority       | Select    | Priority, defines the urgency with which the ticket should be addressed: "urgent", "high", "normal", "low"
| status         | String    | The state of the ticket.
| recipient      | String    | The original recipient e-mail address of the ticket
| requesterId    | Number    | The user who requested this ticket
| submitterId    | Number    | The user who submitted the ticket; The submitter always becomes the author of the first comment on the ticket.
| assigneeId     | Number    | What agent is currently assigned to the ticket
| organizationId | Number    | The organization of the requester. You can only specify the ID of an organization associated with the requester. See Organization Memberships
| groupId        | Number    | The group this ticket is assigned to
| collaboratorIds| JSON      | Who are currently CC'ed on the ticket
| forumTopicId   | Number    | The topic this ticket originated from, if any
| problemId      | Number    | The problem this incident is linked to, if any
| dueAt          | DatePicker| If this is a ticket of type "task" it has a due date. Due date format uses ISO 8601 format.
| tags           | List      | The array of tags applied to this ticket
| customFields   | JSON      | The custom fields of the ticket
| ticketFormId   | Number    | The id of the ticket form to render for this ticket - only applicable for enterprise accounts
| brandId        | Number    | The id of the brand this ticket is associated with - only applicable for enterprise accounts

## ZendeskCore.markSingleTicketAsSpam
Mark Ticket as Spam and Suspend Requester

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID

## ZendeskCore.markTicketsAsSpam
Mark Tickets as Spam and Suspend Requester

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| ticketIds| List  | List of Ticket IDs

## ZendeskCore.mergeTickets
Merges one or more tickets into the {id} target ticket.

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| ticketId     | Number| Ticket ID
| ids          | List  | List of Ticket IDs
| targetComment| String| Private comment to add to the target ticket
| sourceComment| String| Private comment to add to the source ticket

## ZendeskCore.getTicketRelatedInfo
Get ticket related info

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID

## ZendeskCore.deleteSingleTicket
Delete ticket

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID

## ZendeskCore.deleteTickets
Delete tickets

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| ticketIds| List  | List of ticket ids

## ZendeskCore.getTicketCollaborators
Get collaborators from ticket

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID

## ZendeskCore.getTicketIncidents
Get ticket incidents

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID

## ZendeskCore.getTicketsProblems
Get probles tickets

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.autocompleteTicketsProblems
Returns tickets whose type is 'Problem' and whose subject contains the string specified in the text parameter.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| text    | String| Search expression

## ZendeskCore.getAttachment
Get attachment data by ID

| Field       | Type  | Description
|-------------|-------|----------
| apiToken    | String| Access Token
| email       | String| Your e-mail in Zendesk system.
| domain      | String| Your domain in Zendesk system.
| attachmentId| Number| Attachment ID

## ZendeskCore.getComments
Get all comments from ticket

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| ticketId | Number| Ticket ID
| sortOrder| Select| One of asc, desc. Defaults to asc

## ZendeskCore.removeCommentAttachment
Redaction allows you to permanently remove attachments from an existing comment on a ticket. Once removed from a comment, the attachment is replaced with a placeholder 'redacted.txt' file. Note that redaction is permanent. It is not possible to undo redaction or see what was removed. Once a ticket is closed, redacting its attachments is no longer possible.

| Field       | Type  | Description
|-------------|-------|----------
| apiToken    | String| Access Token
| email       | String| Your e-mail in Zendesk system.
| domain      | String| Your domain in Zendesk system.
| ticketId    | Number| Ticket ID
| commentId   | Number| Comment ID
| attachmentId| Number| Attachment ID

## ZendeskCore.deleteAttachment
Remove attachment

| Field       | Type  | Description
|-------------|-------|----------
| apiToken    | String| Access Token
| email       | String| Your e-mail in Zendesk system.
| domain      | String| Your domain in Zendesk system.
| attachmentId| Number| Attachment ID

## ZendeskCore.uploadFiles
Adding multiple attachments to the same upload is handled by splitting requests and passing the API token received from the first request to each subsequent request. The token is valid for 3 days. Note: Even if private attachments are enabled in the Zendesk Support instance, uploaded files are visible to any authenticated user at the content_URL specified in the JSON response until the upload token is consumed. Once an attachment is associated with a ticket or post, visibility is restricted to users with access to the ticket or post with the attachment.

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| file       | File  | File
| fileName   | String| File name
| uploadToken| String| Upload token. Use it when need to upload more then 1 file and associate with token

## ZendeskCore.deleteUpload
Delete upload with all attachments

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| uploadToken| String| Upload token. Use it when need to upload more then 1 file and associate with token

## ZendeskCore.getSatisfactionRatings
List all received satisfaction rating requests ever issued for your account.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleSatisfactionRating
Get single ticket satisfaction rating

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| satisfactionId| Number| Ticket satisfaction rating ID

## ZendeskCore.getSatisfactionRatingReasons
Return list all reasons for an account

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSatisfactionRatingReason
Return list all reasons for an account

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| reasonId| Number| Ticket satisfaction rating ID

## ZendeskCore.createSatisfactionRating
Create a rating for solved tickets, or for tickets that were previously solved and then reopened.

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| ticketId   | Number| Ticket ID
| score      | Select| The rating: "offered", "unoffered", "good" or "bad"
| comment    | String| Text to satisfaction rating message
| requesterId| Number| The id of ticket requester submitting the rating. Default owner of apiToken

## ZendeskCore.getSuspendedTickets
Get all suspended tickets

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getTicketAudits
Lists the audits for a specified ticket.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID

## ZendeskCore.getTicketSingleAudits
Get audit for a specified ticket by audit ID

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID
| auditId | Number| Audit ID

## ZendeskCore.makeAuditPrivate
Hide audit by ID

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID
| auditId | Number| Audit ID

## ZendeskCore.removeWordFromTicketComment
Permanently removes words or strings from a ticket comment. Specify the string to redact in an object with a text property. Example: {"text": "credit-card-number"}. The characters of the word or string are replaced by the ▇ symbol. Redaction is permanent. You can't undo the redaction or see what was removed. Once a ticket is closed, you can no longer redact strings from its comments.

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| ticketId | Number| Ticket ID
| commentId| Number| Comment ID
| text     | String| Text to search

## ZendeskCore.makeCommentPrivate
Make comment private

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| ticketId | Number| Ticket ID
| commentId| Number| Comment ID

## ZendeskCore.getSkippedTickets
Get all skipped tickets

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.skipTicket
Record a new skip for the current user

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID
| reason  | String| Reason to skip

## ZendeskCore.getTicketMetrics
Listing Ticket Metrics

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleMetric
Get ticket metric by metric ID

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| ticketMetricId| Number| Ticket metric ID

## ZendeskCore.getSingleTicketMetric
Get ticket metric by ticket ID

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID

## ZendeskCore.getTicketMetricEvents
List ticket metric events

| Field    | Type      | Description
|----------|-----------|----------
| apiToken | String    | Access Token
| email    | String    | Your e-mail in Zendesk system.
| domain   | String    | Your domain in Zendesk system.
| startTime| DatePicker| Date

## ZendeskCore.getAllRequests
Get list of requests

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| sortBy   | Select| Possible values are updated_at, created_at
| sortOrder| Select| One of asc, desc. Defaults to asc

## ZendeskCore.getRequestListByStatus
Get list of requests by status

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| status   | List  | List of request's statuses
| sortBy   | Select| Possible values are updated_at, created_at
| sortOrder| Select| One of asc, desc. Defaults to asc

## ZendeskCore.getOpenedRequestList
Get list of opened request

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| sortBy   | Select| Possible values are updated_at, created_at
| sortOrder| Select| One of asc, desc. Defaults to asc

## ZendeskCore.getSolvedRequestList
Get list of solved request

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| sortBy   | Select| Possible values are updated_at, created_at
| sortOrder| Select| One of asc, desc. Defaults to asc

## ZendeskCore.getCcdRequestList
Get request list

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| sortBy   | Select| Possible values are updated_at, created_at
| sortOrder| Select| One of asc, desc. Defaults to asc

## ZendeskCore.getRequestListByUser
Get request by user ID

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| userId   | Number| User ID
| sortBy   | Select| Possible values are updated_at, created_at
| sortOrder| Select| One of asc, desc. Defaults to asc

## ZendeskCore.getRequestListByOrganization
Get request by organization ID

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| organizationId| Number| Organization ID
| sortBy        | Select| Possible values are updated_at, created_at
| sortOrder     | Select| One of asc, desc. Defaults to asc

## ZendeskCore.getSingleRequest
Get request by ID

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| requestId| Number| Request ID

## ZendeskCore.getRequestComments
Get comments from request

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| requestId| Number| Request ID
| sortBy   | Select| Possible values are updated_at, created_at
| sortOrder| Select| One of asc, desc. Defaults to asc

## ZendeskCore.getRequestSingleComment
Get single comment from request

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| requestId| Number| Request ID
| commentId| Number| Comment ID
| sortBy   | Select| Possible values are updated_at, created_at
| sortOrder| Select| One of asc, desc. Defaults to asc

## ZendeskCore.createGroup
Create group

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| name    | String| Group name

## ZendeskCore.getGroups
Get list of groups

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getUserGroups
Get User's list groups

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID

## ZendeskCore.getSingleGroup
Get single group by ID

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| groupId | Number| Group ID

## ZendeskCore.getAssignableGroups
Get assignable groups

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.updateGroup
Update group

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| groupId | Number| Group ID
| name    | String| New name of group

## ZendeskCore.deleteGroup
Delete group

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| groupId | Number| Group ID

## ZendeskCore.getMemberships
Get list of memberships

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getUserMemberships
Get list of user memberships

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID

## ZendeskCore.getGroupMemberships
Get group list of memberships

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| groupId | Number| Group ID

## ZendeskCore.getAssignableMemberships
List Assignable Memberships

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getGroupAssignableMemberships
Get Group Assignable Memberships

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| groupId | Number| Group ID

## ZendeskCore.getUserSingleMembership
Get user single membership

| Field            | Type  | Description
|------------------|-------|----------
| apiToken         | String| Access Token
| email            | String| Your e-mail in Zendesk system.
| domain           | String| Your domain in Zendesk system.
| userId           | Number| User ID
| groupMembershipId| Number| Group membership ID

## ZendeskCore.getSingleGroupMembership
Get single group membership

| Field            | Type  | Description
|------------------|-------|----------
| apiToken         | String| Access Token
| email            | String| Your e-mail in Zendesk system.
| domain           | String| Your domain in Zendesk system.
| groupMembershipId| Number| Group membership ID

## ZendeskCore.createMembership
Create group membership

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID
| groupId | Number| Group ID

## ZendeskCore.deleteMembership
Immediately removes a user from a group and schedules a job to unassign all working tickets that are assigned to the given user and group combination.

| Field            | Type  | Description
|------------------|-------|----------
| apiToken         | String| Access Token
| email            | String| Your e-mail in Zendesk system.
| domain           | String| Your domain in Zendesk system.
| groupMembershipId| Number| Group membership ID

## ZendeskCore.deleteMemberships
Immediately removes users from groups and schedules a job to unassign all working tickets that are assigned to the given user and group combinations.

| Field             | Type  | Description
|-------------------|-------|----------
| apiToken          | String| Access Token
| email             | String| Your e-mail in Zendesk system.
| domain            | String| Your domain in Zendesk system.
| groupMembershipIds| List  | List of group membership ids

## ZendeskCore.setGroupMembershipAsDefault
Set group membership as Default

| Field            | Type  | Description
|------------------|-------|----------
| apiToken         | String| Access Token
| email            | String| Your e-mail in Zendesk system.
| domain           | String| Your domain in Zendesk system.
| userId           | Number| User ID
| groupMembershipId| Number| Group membership ID

## ZendeskCore.getUsers
Get list Users

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| role         | Select  Users role. Example: end-user, admin
| permissionSet| Number| For custom roles in the Enterprise plan. You can only filter by one role id per request

## ZendeskCore.getGroupUsers
Get list Users of group

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| groupId | Number| Group ID

## ZendeskCore.getOrganizationUsers
Get list Users of group

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| organizationId| Number| Organization ID

## ZendeskCore.getUsersByIds
Get Users by Id list

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userIds | List  | List of user ids

## ZendeskCore.getUsersByExternalIds
Get Users by External Id list

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| externalIds| List  | List of user's external ids

## ZendeskCore.getUserRelatedInfo
Get user related info

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID

## ZendeskCore.createUser
Create a new user

| Field              | Type   | Description
|--------------------|--------|----------
| apiToken           | String | Access Token
| email              | String | Your e-mail in Zendesk system.
| domain             | String | Your domain in Zendesk system.
| name               | String | User name
| email              | String | User email
| verified           | Boolean| True - if you need to create users without sending out a verification email.
| role               | Select | If you need to create agents with a specific role, the role parameter only accepts three possible values: "end-user", "agent", "admin".
| customRoleId       | Number | Therefore you will need to set role to "agent" as well as add a new parameter called "custom_role_id" and give it the actual desired role ID from your Zendesk Support account.
| twitter            | String | User's twitter
| facebook           | String | User's facebook
| alias              | String | An alias displayed to end users
| details            | String | Any details you want to store about the user, such as an address
| externalId         | String | A unique id you can specify for the user
| localeId           | Number | The user's language identifier
| moderator          | Boolean| Designates whether the user has forum moderation capabilities
| notes              | String | Any notes you want to store about the user
| onlyPrivateComments| Boolean| True if the user can only create private comments
| organizationId     | Number | The id of the organization the user is associated with
| defaultGroupId     | Number | The id of the user's default group. *Can only be set on create, not on update
| phone              | String | The user's primary phone number. See Phone Number below
| restrictedAgent    | Boolean| If the agent has any restrictions; false for admins and unrestricted agents, true for other agents
| signature          | String | The user's signature. Only agents and admins can have signatures
| suspended          | Boolean| If the agent is suspended. Tickets from suspended users are also suspended, and these users cannot sign in to the end user portal
| tags               | List   | The user's tags. Only present if your account has user tagging enabled
| ticketRestriction  | String | Specifies which tickets the user has access to. Possible values are: "organization", "groups", "assigned", "requested", null
| timeZone           | String | The user's time zone. See Time Zone below
| userFields         | JSON   | Custom fields for the user


## ZendeskCore.mergeUsers
Merge two users

| Field       | Type  | Description
|-------------|-------|----------
| apiToken    | String| Access Token
| email       | String| Your e-mail in Zendesk system.
| domain      | String| Your domain in Zendesk system.
| userId      | Number| This user will be merged into the existing user provided in the target user id param. Any two arbitrary users can be merged.
| targetUserId| Number| User ID to which will be merged

## ZendeskCore.deleteUsersByIds
Delete users

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userIds | List  | User id list

## ZendeskCore.autocompleteUsers
Returns an array of users whose name starts with the value specified in the name paramater. It only returns users with no foreign identities.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| name    | String| The text from which the name begins


## ZendeskCore.getMe
Show the Currently Authenticated User

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.setUserPassword
An admin can set a user's password only if the setting is enabled under Settings > Security > Global. The setting is off by default. Only the account owner can access and change this setting in Zendesk Support.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID
| password| String| New password

## ZendeskCore.updatePassword
You can only change your own password. Nobody can change the password of another user because it requires knowing the user's existing password. However, an admin can set a new password for another user without knowing the existing password. See "Set a User's Password" above.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| Your User ID
| password| String| New password

## ZendeskCore.getPasswordRequirements
Get a list of password requirements

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| Your User ID

## ZendeskCore.getIdentities
Returns all user identities for a given user id.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| Your User ID

## ZendeskCore.getSingleIdentity
Shows the identity with the given id.

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| userId    | Number| Your User ID
| identityId| Number| User identity ID

## ZendeskCore.createIdentity
Adds a new identity to a user's profile. An agent can add an identity to any user profile.

| Field             | Type   | Description
|-------------------|--------|----------
| apiToken          | String | Access Token
| email             | String | Your e-mail in Zendesk system.
| domain            | String | Your domain in Zendesk system.
| userId            | Number | User ID
| type              | Select | New identity: email, twitter, facebook or google
| value             | String | Value of new identity
| primary           | Boolean| Set identity primary or not
| verified          | Boolean| If the identity has been verified
| undeliverableCount| Number | The number of times a non-delivery response was received at that address (maximum 50)
| deliverableState  | Select | One of "deliverable" or "ticket_sharing_partner"

## ZendeskCore.createSelfIdentity
Add an identity to their own user profile

| Field             | Type   | Description
|-------------------|--------|----------
| apiToken          | String | Access Token
| email             | String | Your e-mail in Zendesk system.
| domain            | String | Your domain in Zendesk system.
| userId            | Number | User ID
| type              | Select | New identity: email, twitter, facebook or google
| value             | String | Value of new identity
| primary           | Boolean| If the identity is the primary identity. *Writable only when creating, not when updating. Use the makeIdentifyPrimary endpoint instead
| verified          | Boolean| If the identity has been verified
| undeliverableCount| Number | The number of times a non-delivery response was received at that address (maximum 50)
| deliverableState  | Select | One of "deliverable" or "ticket_sharing_partner"

## ZendeskCore.updateIdentity
This endpoint allows you to set the specified identity as verified (but you cannot unverify a verified identity and update the value of the specified identity

| Field             | Type   | Description
|-------------------|--------|----------
| apiToken          | String | Access Token
| email             | String | Your e-mail in Zendesk system.
| domain            | String | Your domain in Zendesk system.
| userId            | Number | User ID
| identityId        | Number | Identity ID
| name              | String | Identity name. Example: email, twitter, verified etc. You cant change primary identity value. For more details look at getIdentities
| value             | String | Value of identity
| verified          | Boolean| Change verified status
| type              | Select | type of identity
| undeliverableCount| Number | The number of times a non-delivery response was received at that address (maximum 50)
| deliverableState  | Select | One of "deliverable" or "ticket_sharing_partner"

## ZendeskCore.makeIdentityPrimary
Sets the specified identity as primary. Only fort Agents

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| userId    | Number| User ID
| identityId| Number| Identity ID

## ZendeskCore.makeMyIdentityPrimary
Sets the own identity as primary. For verified end users

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| userId    | Number| Your user ID
| identityId| Number| Your identity ID

## ZendeskCore.verifyIdentity
Sets the specified identity as verified.

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| userId    | Number| User ID
| identityId| Number| Identity ID

## ZendeskCore.requestUserVerification
Sends the user a verification email with a link to verify ownership of the email address.

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| userId    | Number| User ID
| identityId| Number| Identity ID

## ZendeskCore.deleteIdentity
Deletes the identity for a given user.

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| userId    | Number| User ID
| identityId| Number| Identity ID

## ZendeskCore.getCustomRoles
Get custom roles. Available only in Enterprise plan and Professional plan with the Light Agents add-on

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getEndUser
Get end-user by ID

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID

## ZendeskCore.updateUser
Update end-users

| Field              | Type   | Description
|--------------------|--------|----------
| apiToken           | String | Access Token
| email              | String | Your e-mail in Zendesk system.
| domain             | String | Your domain in Zendesk system.
| userId             | Number | User ID
| name               | String | New user name
| email              | String | User email
| verified           | Boolean| True - if you need to create users without sending out a verification email.
| role               | String | If you need to create agents with a specific role, the role parameter only accepts three possible values: "end-user", "agent", "admin".
| customRoleId       | Number | Therefore you will need to set role to "agent" as well as add a new parameter called "custom_role_id" and give it the actual desired role ID from your Zendesk Support account.
| twitter            | String | User's twitter
| facebook           | String | User's facebook
| alias              | String | An alias displayed to end users
| details            | String | Any details you want to store about the user, such as an address
| externalId         | String | A unique id you can specify for the user
| localeId           | Number | The user's language identifier
| moderator          | Boolean| Designates whether the user has forum moderation capabilities
| notes              | String | Any notes you want to store about the user
| onlyPrivateComments| Boolean| True if the user can only create private comments
| organizationId     | Number | The id of the organization the user is associated with
| phone              | String | The user's primary phone number. See Phone Number below
| restrictedAgent    | Boolean| If the agent has any restrictions; false for admins and unrestricted agents, true for other agents
| signature          | String | The user's signature. Only agents and admins can have signatures
| suspended          | Boolean| If the agent is suspended. Tickets from suspended users are also suspended, and these users cannot sign in to the end user portal
| tags               | List   | The user's tags list. Only present if your account has user tagging enabled
| ticketRestriction  | Select | Specifies which tickets the user has access to. Possible values are: "organization", "groups", "assigned", "requested", null
| timeZone           | String | The user's time zone. See Time Zone below
| userFields         | List   | Custom fields for the user

## ZendeskCore.getSessions
Get list of sessions

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getUsersSessions
Get user's list of sessions

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID

## ZendeskCore.getSingleSession
Get session by ID

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| userId   | Number| User ID
| sessionId| Number| Session ID

## ZendeskCore.deleteSession
Delete single session

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| userId   | Number| User ID
| sessionId| Number| Session ID

## ZendeskCore.deleteAllSessions
Delete all session for current user

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID

## ZendeskCore.logout
Deletes the current session. In practice, this only works when using session auth for requests, such as client-side requests made from a Zendesk app. When using OAuth or basic authentication, you don't have a current session so this endpoint has no effect.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getOrganizations
Return list of organization

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getUserOrganizations
Return list of users's organization

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID

## ZendeskCore.autocompleteOrganizations
Returns an array of organizations whose name starts with the value specified in the name parameter.

| Field           | Type  | Description
|-----------------|-------|----------
| apiToken        | String| Access Token
| email           | String| Your e-mail in Zendesk system.
| domain          | String| Your domain in Zendesk system.
| organizationName| String| Part of organization name

## ZendeskCore.getOrganizationRelatedInfo
Get organization info by ID

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| organizationId| Number| Organization ID

## ZendeskCore.getOrganizationsByIds
Get organizations by IDs

| Field          | Type  | Description
|----------------|-------|----------
| apiToken       | String| Access Token
| email          | String| Your e-mail in Zendesk system.
| domain         | String| Your domain in Zendesk system.
| organizationIds| List  | List of organization ID

## ZendeskCore.createOrganization
Create new organization

| Field             | Type   | Description
|-------------------|--------|----------
| apiToken          | String | Access Token
| email             | String | Your e-mail in Zendesk system.
| domain            | String | Your domain in Zendesk system.
| name              | String | New organization name
| details           | String | Any details obout the organization, such as the address
| notes             | String | Any notes you have about the organization
| tags              | List   | The tags of the organization
| organizationFields| JSON   | Custom fields for this organization. Example: ["org_dropdown": "option_1", "org_decimal": 5.2]

## ZendeskCore.searchOrganizations
Search organization by external_id

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| externalId| Number| External ID

## ZendeskCore.createOrganizationSubscription
Create organization subscription. End users can only subscribe to shared organizations in which they're members.

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| userId        | Number| User ID
| organizationId| Number| Organization subscription ID

## ZendeskCore.getListOrganizationSubscriptions
Get list of all organizations and subscriptions

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleOrganizationSubscriptions
Get list of all single organization subscriptions

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| organizationId| Number| Organization ID

## ZendeskCore.getUserOrganizationSubscriptions
Get list of all user organization subscriptions

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID

## ZendeskCore.getSingleOrganizationSubscription
Get organization subscription

| Field                     | Type  | Description
|---------------------------|-------|----------
| apiToken                  | String| Access Token
| email                     | String| Your e-mail in Zendesk system.
| domain                    | String| Your domain in Zendesk system.
| organizationSubscriptionId| Number| Organization subscription ID

## ZendeskCore.getListOrganizationMemberships
Get list of all organization memberships

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getUserOrganizationMemberships
Get list of single user memberships

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | String| User ID

## ZendeskCore.getSingleOrganizationMemberships
Get list of single organization memberships

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| organizationId| String| Organization ID

## ZendeskCore.getSingleMembership
Get single organization membership

| Field                   | Type  | Description
|-------------------------|-------|----------
| apiToken                | String| Access Token
| email                   | String| Your e-mail in Zendesk system.
| domain                  | String| Your domain in Zendesk system.
| userId                  | Number| User ID
| organizationMembershipId| Number| Organization membership ID

## ZendeskCore.createOrganizationMembership
Create new organization membership

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| userId        | Number| User ID
| organizationId| String| Organization ID

## ZendeskCore.setOrganizationMembershipAsDefault
Set organization membership as default

| Field                   | Type  | Description
|-------------------------|-------|----------
| apiToken                | String| Access Token
| email                   | String| Your e-mail in Zendesk system.
| domain                  | String| Your domain in Zendesk system.
| userId                  | Number| User ID
| organizationMembershipId| Number| Organization membership ID

## ZendeskCore.deleteOrganizationMembershipsByIds
Immediately removes a user from a organization and schedules a job to unassign all working tickets that are assigned to the given user and organization combination

| Field                    | Type  | Description
|--------------------------|-------|----------
| apiToken                 | String| Access Token
| email                    | String| Your e-mail in Zendesk system.
| domain                   | String| Your domain in Zendesk system.
| organizationMembershipIds| List  | List of organization membership IDs

## ZendeskCore.searchUsersByQuery
Specify a partial or full name or email address as the value of the query attribute. Example: query="Gerry". Specify an id number as the value of the external_id attribute. For more advanced searches of users, use the Search API.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| query   | String| Query string to search

## ZendeskCore.searchUsersByIds
Search users by IDs

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| externalId| String| External ID

## ZendeskCore.updateUsersByIds
Update users with the same data

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userIds | List  | List of user IDs to update same data
| params  | JSON  | Param to be updated to all users, which ids send. Example: {"organization_id": 1}

## ZendeskCore.updateUsersByExternalIds
Update users with the same data

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| externalIds| List  | List of user external IDs to update same data
| params     | JSON  | Param to be updated to all users, which ids send. Example: {"organization_id": 1}

## ZendeskCore.updateUsers
Update users with the different data by id or externalId

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| params  | JSON  | Param to be updated to all users, which ids send. Example:  [{ "id": 10071, "name": "New Name", "organization_id": 1 },{ "external_id": "123", "verified": true }]. In each element in array required id or externalId.

## ZendeskCore.updateOrganizationsByIds
Update organization with the same data by id

| Field          | Type  | Description
|----------------|-------|----------
| apiToken       | String| Access Token
| email          | String| Your e-mail in Zendesk system.
| domain         | String| Your domain in Zendesk system.
| organizationIds| List  | List of organization ID
| params         | JSON  | Param to be updated to all users, which ids send. Example: {"notes": "Something interesting"}. In each element in array required id or externalId.

## ZendeskCore.updateOrganizationsByExternalIds
Update organization with the same data by external id

| Field                  | Type  | Description
|------------------------|-------|----------
| apiToken               | String| Access Token
| email                  | String| Your e-mail in Zendesk system.
| domain                 | String| Your domain in Zendesk system.
| organizationExternalIds| List  | List of organization external ID
| params                 | JSON  | Param to be updated to all users, which ids send. Example: {"notes": "Something interesting"}. In each element in array required id or externalId.

## ZendeskCore.updateOrganizations
Update organization with the different data by id or external id

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| params  | JSON  | Param to be updated to all users, which ids send. Example: [{"id": 1, "notes": "Something interesting" },{ "external_id": "2", "notes": "Something even more interesting"}]. In each element in array required id or externalId.

## ZendeskCore.deleteOrganizationSubscription
Delete organization subscription

| Field                     | Type  | Description
|---------------------------|-------|----------
| apiToken                  | String| Access Token
| email                     | String| Your e-mail in Zendesk system.
| domain                    | String| Your domain in Zendesk system.
| organizationSubscriptionId| Number| Organization subscription ID

## ZendeskCore.deleteOrganizationsByIds
Delete organizations by ids

| Field          | Type  | Description
|----------------|-------|----------
| apiToken       | String| Access Token
| email          | String| Your e-mail in Zendesk system.
| domain         | String| Your domain in Zendesk system.
| organizationIds| List  | List of organization ID

## ZendeskCore.createSearchQuery
The search API is a unified search API that returns tickets, users, and organizations. You can define filters to narrow your search results according to resource type, dates, and object properties, such as ticket requester or tag.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| query   | String| Params to search

## ZendeskCore.createTicketComment
Create ticket comment

| Field          | Type   | Description
|----------------|--------|----------
| apiToken       | String | Access Token
| email          | String | Your e-mail in Zendesk system.
| domain         | String | Your domain in Zendesk system.
| ticketId       | Number | Ticket ID
| commentBody    | String | Comment
| commentHtmlBody| String | HTML code of comment
| commentAuthorId| Number | Author ID of comment. If not set, system use owner of apiToken
| commentShow    | Boolean| False - make comment private

## ZendeskCore.searchRequests
Search requests by params

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| query         | String| Expression to find
| organizationId| Number| Organization ID
| status        | List  | Ticket status: open, solved

## ZendeskCore.createRequest
Create single request

| Field           | Type   | Description
|-----------------|--------|----------
| apiToken        | String | Access Token
| email           | String | Your e-mail in Zendesk system.
| domain          | String | Your domain in Zendesk system.
| subject         | String | Ticket title
| description     | String | Ticket body
| status          | Select | The state of the request, "new", "open", "pending", "hold", "solved", "closed"
| priority        | Select | The priority of the request, "low", "normal", "high", "urgent"
| type            | Select | The type of the request, "question", "incident", "problem", "task"
| customFields    | JSON   | The fields and entries for this request
| organizationId  | Number | The organization of the requester
| requesterId     | Number | The id of the requester
| assigneeId      | Number | The id of the assignee if the field is visible to end users
| groupId         | Number | The id of the assigned group if the field is visible to end users
| collaboratorIds | List   | Who are currently CC'ed on the ticket
| isPublic        | Boolean| Is true if any comments are public, false otherwise
| canBeSolvedByMe | Boolean| If true, end user can mark request as solved.
| solved          | Boolean| Whether or not request is solved (an end user can set this if "can_be_solved_by_me", above, is true for that user)
| ticketFormId    | Number | The numeric id of the ticket form associated with this request if the form is visible to end users - only applicable for enterprise accounts
| recipient       | String | The original recipient e-mail address of the request
| followupSourceId| Number | The id of the original ticket if this request is a follow-up ticket

## ZendeskCore.updateRequest
Update single request

| Field       | Type   | Description
|-------------|--------|----------
| apiToken    | String | Access Token
| email       | String | Your e-mail in Zendesk system.
| domain      | String | Your domain in Zendesk system.
| requestId   | Number | Request ID
| subject     | String | Ticket title
| comment     | String | Comment body
| status      | Select | The state of the request, "new", "open", "pending", "hold", "solved", "closed"
| priority    | Select | The priority of the request, "low", "normal", "high", "urgent"
| type        | Select | The type of the request, "question", "incident", "problem", "task"
| customFields| JSON   | The fields and entries for this request
| solved      | Boolean| Whether or not request is solved (an end user can set this if "can_be_solved_by_me", above, is true for that user)
| ticketFormId| Number | The numeric id of the ticket form associated with this request if the form is visible to end users - only applicable for enterprise accounts
| recipient   | String | The original recipient e-mail address of the request

## ZendeskCore.getActions
Lists all automations for the current account

| Field    | Type   | Description
|----------|--------|----------
| apiToken | String | Access Token
| email    | String | Your e-mail in Zendesk system.
| domain   | String | Your domain in Zendesk system.
| active   | Boolean| Only active automations if true, inactive automations if false
| sortBy   | Select | Possible values are alphabetical, created_at, updated_at, usage_1h, usage_24h, or usage_7d. Defaults to position
| sortOrder| Select | One of asc or desc. Defaults to asc for alphabetical and position sort, desc for all others

## ZendeskCore.getSingleAutomation
Get single automation by ID

| Field       | Type  | Description
|-------------|-------|----------
| apiToken    | String| Access Token
| email       | String| Your e-mail in Zendesk system.
| domain      | String| Your domain in Zendesk system.
| automationId| Number| Automation ID

## ZendeskCore.getActiveAutomations
Lists all active automations

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| sortBy   | Select| Possible values are alphabetical, created_at, updated_at, usage_1h, usage_24h, or usage_7d. Defaults to position
| sortOrder| Select| One of asc or desc. Defaults to asc for alphabetical and position sort, desc for all others

## ZendeskCore.createAutomation
Create automation

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| automationData| JSON  | Params of new automation https://developer.zendesk.com/rest_api/docs/core/automations#create-automation

## ZendeskCore.updateAutomation
Update automation

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| automationId  | Number| Automation ID
| automationData| JSON  | Params of new automation https://developer.zendesk.com/rest_api/docs/core/automations#create-automation

## ZendeskCore.deleteAutomation
Delete automation

| Field       | Type  | Description
|-------------|-------|----------
| apiToken    | String| Access Token
| email       | String| Your e-mail in Zendesk system.
| domain      | String| Your domain in Zendesk system.
| automationId| Number| Automation ID

## ZendeskCore.searchAutomations
Search automation with params

| Field    | Type   | Description
|----------|--------|----------
| apiToken | String | Access Token
| email    | String | Your e-mail in Zendesk system.
| domain   | String | Your domain in Zendesk system.
| query    | String | Query string used to find all automations with matching title
| active   | Boolean| Only active automations if true, inactive automations if false
| sortBy   | Select | Possible values are alphabetical, created_at, updated_at, and position. If unspecified, the automations are sorted by relevance
| sortOrder| Select | One of asc or desc. Defaults to asc for alphabetical and position sort, desc for all others

## ZendeskCore.getMacrosList
Lists all shared and personal macros available to the current user.

| Field       | Type   | Description
|-------------|--------|----------
| apiToken    | String | Access Token
| email       | String | Your e-mail in Zendesk system.
| domain      | String | Your domain in Zendesk system.
| access      | Select | Only macros with given access. Possible values are personal, shared, or account
| active      | Boolean| Only active macros if true, inactive macros if false
| category    | String | Only macros within given category
| groupId     | Number | Only macros belonging to given group
| onlyViewable| Boolean| Only macros that can be applied to tickets if true, All macros the current user can manage if false. Defaults to false
| sortBy      | Select | Possible values are alphabetical, created_at, updated_at, usage_1h, usage_24h, or usage_7d. Defaults to alphabetical
| sortOrder   | Select | One of asc or desc. Defaults to asc for alphabetical and position sort, desc for all others

## ZendeskCore.getSingleMacro
Get single Macro by ID

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| macroId | Number| Macro ID

## ZendeskCore.getActiveMacros
Lists all active shared and personal macros available to the current user.

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| access   | Select| Only macros with given access. Possible values are personal, shared, or account
| category | String| Only macros within given category
| groupId  | Number| Only macros belonging to given group
| sortBy   | Select| Possible values are alphabetical, created_at, updated_at, usage_1h, usage_24h, or usage_7d. Defaults to alphabetical
| sortOrder| Select| One of asc or desc. Defaults to asc for alphabetical and position sort, desc for all others

## ZendeskCore.createMacro
Create macro

| Field      | Type   | Description
|------------|--------|----------
| apiToken   | String | Access Token
| email      | String | Your e-mail in Zendesk system.
| domain     | String | Your domain in Zendesk system.
| title      | String | The title of the macro
| description| String | The description of the macro
| position   | Number | The position of the macro
| active     | Boolean| Useful for determining if the macro should be displayed
| actions    | Array  | An object describing what the macro will do. Example: { "field": "status", "value": "solved" }
| restriction| Array  | Who may access this macro. Will be null when everyone in the account can access it

## ZendeskCore.updateMacro
Update macro

| Field      | Type   | Description
|------------|--------|----------
| apiToken   | String | Access Token
| email      | String | Your e-mail in Zendesk system.
| domain     | String | Your domain in Zendesk system.
| macroId    | Number | Macro ID
| title      | String | The title of the macro
| description| String | The description of the macro
| position   | Number | The position of the macro
| active     | Boolean| Useful for determining if the macro should be displayed
| actions    | Array  | An object describing what the macro will do. Example: { "field": "status", "value": "solved" }
| restriction| Array  | Who may access this macro. Will be null when everyone in the account can access it

## ZendeskCore.deleteMacro
Delete macro

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| macroId | Number| Macro ID

## ZendeskCore.showChangesToTicket
Returns the changes the macro would make to a ticket. It doesn't actually change a ticket. You can use the response data in a subsequent API call to the Tickets endpoint to update the ticket. The response includes only the ticket fields that would be changed by the macro. To get the full ticket object after the macro is applied, see Show Ticket After Changes below.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| macroId | Number| Macro ID

## ZendeskCore.showTicketAfterChanges
Returns the full ticket object as it would be after applying the macro to the ticket. It doesn't actually change the ticket. You can use the response data in a subsequent API call to the Tickets endpoint to update the ticket. To get only the ticket fields that would be changed by the macro, see Show Changes to Ticket.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID
| macroId | Number| Macro ID

## ZendeskCore.getMacroCategories
Lists all macro categories available to the current user.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.searchMacros
Search macros by title

| Field       | Type   | Description
|-------------|--------|----------
| apiToken    | String | Access Token
| email       | String | Your e-mail in Zendesk system.
| domain      | String | Your domain in Zendesk system.
| query       | String | Query string used to find macros with matching titles
| access      | String | List macros with the given access. Possible values are personal, shared, or account
| active      | Boolean| List active macros if true; inactive macros if false
| category    | String | List macros in the given category
| groupId     | Number | List macros belonging to given group
| onlyViewable| Boolean| List macros that can be applied to tickets if true; list all macros the current user can manage if false. Default is false
| sortBy      | Select | Possible values are alphabetical, created_at, updated_at, and position. If unspecified, the macros are sorted by relevance
| sortOrder   | Select | One of asc or desc. Defaults to asc for alphabetical and position sort, desc for all others

## ZendeskCore.getSupportedActionsForMacros
List supported actions for macros

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.showMacroReplica
Returns an unpersisted macro representation derived from a ticket or macro.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| macroId | Number| ID of the macro to replicate. You must pass this value or ticketId
| ticketId| Number| ID of the ticket from which to build a macro replica. You must pass this value or macroId

## ZendeskCore.getSLAPolicies
Get Service Level Agreements. Accounts on the Professional and Enterprise plans

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleSLAPolicy
Get single SLA Policy

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| slaPolicyId| Number| SLA Policy ID

## ZendeskCore.createSLAPolicy
Create SLA Policy

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| slaPolicyData| JSON  | SLA Policy params

## ZendeskCore.updateSLAPolicy
Create SLA Policy

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| slaPolicyId  | Number| SLA Policy ID
| slaPolicyData| JSON  | SLA Policy params

## ZendeskCore.deleteSLAPolicy
Delete SLA Policy

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| slaPolicyId| Number| SLA Policy ID

## ZendeskCore.reorderSLAPolicies
Reorder SLA Policies

| Field       | Type  | Description
|-------------|-------|----------
| apiToken    | String| Access Token
| email       | String| Your e-mail in Zendesk system.
| domain      | String| Your domain in Zendesk system.
| slaPolicyIds| List  | List of SLA Policy IDs

## ZendeskCore.getSupportedFilterDefinitionItems
Retrieve supported filter definition items. Accounts on the Professional and Enterprise plans only

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getTargets
Targets are pointers to cloud-based applications and services such as Twitter and Twilio, as well as to HTTP and email addresses. You can use targets with triggers and automations to send a notification to the target when a ticket is created or updated.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleTarget
Get single target

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| targetId| Number| Target ID

## ZendeskCore.createTarget
Create target

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| targetData| JSON  | Target data

## ZendeskCore.updateTarget
Update target

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| targetId  | Number| Target ID
| targetData| JSON  | Target data

## ZendeskCore.deleteTarget
Delete target

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| targetId| Number| Target ID

## ZendeskCore.getTriggers
Lists all triggers for the current account

| Field    | Type   | Description
|----------|--------|----------
| apiToken | String | Access Token
| email    | String | Your e-mail in Zendesk system.
| domain   | String | Your domain in Zendesk system.
| active   | Boolean| Only active triggers if true, inactive triggers if false
| sortBy   | Select | Possible values are alphabetical, created_at, updated_at, usage_1h, usage_24h, or usage_7d. Defaults to position
| sortOrder| Select | One of asc or desc. Defaults to asc for alphabetical and position sort, desc for all others

## ZendeskCore.getSingleTrigger
Get single trigger by ID

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| triggerId| Number| Trigger ID

## ZendeskCore.getActiveTriggers
Lists all active triggers

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| sortBy   | Select| Possible values are alphabetical, created_at, updated_at, usage_1h, usage_24h, or usage_7d. Defaults to position
| sortOrder| Select| One of asc or desc. Defaults to asc for alphabetical and position sort, desc for all others

## ZendeskCore.createTrigger
Create trigger

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| triggerData| JSON  | Trigger params

## ZendeskCore.updateTrigger
Create trigger

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| triggerId  | Number| Trigger ID
| triggerData| JSON  | Trigger params

## ZendeskCore.deleteTrigger
Delete trigger

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| triggerId| Number| Trigger ID

## ZendeskCore.reorderTriggers
Reorder triggers

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| triggerIds| List  | List of trigger IDs

## ZendeskCore.searchTriggers
Search triggers by query in title

| Field    | Type   | Description
|----------|--------|----------
| apiToken | String | Access Token
| email    | String | Your e-mail in Zendesk system.
| domain   | String | Your domain in Zendesk system.
| query    | String | Query string used to find all triggers with matching title
| active   | Boolean| Only active triggers if true, inactive triggers if false
| sortBy   | Select | Possible values are alphabetical, created_at, updated_at, and position. If unspecified, the triggers are sorted by relevance
| sortOrder| Select | One of asc or desc. Defaults to asc for alphabetical and position sort, desc for all others

## ZendeskCore.getViews
Lists shared and personal Views available to the current user

| Field    | Type   | Description
|----------|--------|----------
| apiToken | String | Access Token
| email    | String | Your e-mail in Zendesk system.
| domain   | String | Your domain in Zendesk system.
| access   | String | Only views with given access. May be personal, shared, or account
| active   | Boolean| Only active views if true, inactive views if false
| groupId  | Number | Only views belonging to given group
| sortBy   | Select | Possible values are alphabetical, created_at, or updated_at. Defaults to position
| sortOrder| Select | One of asc or desc. Defaults to asc for alphabetical and position sort, desc for all others

## ZendeskCore.getActiveViews
Lists active shared and personal Views available to the current user

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| access   | String| Only views with given access. May be personal, shared, or account
| groupId  | Number| Only views belonging to given group
| sortBy   | Select| Possible values are alphabetical, created_at, or updated_at. Defaults to position
| sortOrder| Select| One of asc or desc. Defaults to asc for alphabetical and position sort, desc for all others

## ZendeskCore.getSingleView
Get single view by ID

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| viewId  | Number| A view consists of one or more conditions that define a collection of tickets to display.

## ZendeskCore.createView
Create view

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| viewData| JSON  | A view consists of one or more conditions that define a collection of tickets to display.

## ZendeskCore.updateView
Update view

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| viewId  | Number| View ID
| viewData| JSON  | A view consists of one or more conditions that define a collection of tickets to display.

## ZendeskCore.deleteView
Delete view

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| viewId  | Number| View ID

## ZendeskCore.executeView
You execute a view in order to get the tickets that fulfill the conditions of the view.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| viewId  | Number| View ID

## ZendeskCore.getTicketsFromView
Get tickets from a view

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| viewId  | Number| View ID

## ZendeskCore.getViewsCounts
Calculates the size of the view in terms of number of tickets the view will return. Only returns values for personal and shared views accessible to the user performing the request.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| viewIds | List  | List of view IDs

## ZendeskCore.getSingleViewCount
Returns the ticket count for a single view.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| viewId  | Number| View IDs

## ZendeskCore.exportViews
Returns the csv attachment of the current view if possible. Enqueues job to produce the csv if necessary

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| viewId  | Number| View IDs

## ZendeskCore.searchViews
Search views

| Field    | Type   | Description
|----------|--------|----------
| apiToken | String | Access Token
| email    | String | Your e-mail in Zendesk system.
| domain   | String | Your domain in Zendesk system.
| query    | String | Query string used to find all views with matching title
| access   | String | Only views with given access. May be personal, shared, or account
| active   | Boolean| Only active views if true, inactive views if false
| groupId  | Number | Only views belonging to given group
| sortBy   | Select | Possible values are alphabetical, created_at, updated_at, and position. If unspecified, the views are sorted by relevance
| sortOrder| Select | One of asc or desc. Defaults to asc for alphabetical and position sort, desc for all other

## ZendeskCore.getAccountSettings
Shows the settings that are available for the account.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.updateAccountSettings
Updates settings for the account. See JSON Format from getAccountSettings for the settings you can update.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| settings| JSON  | New data for account settings

## ZendeskCore.getAuditLogs
Listing Audit Logs

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleAuditLog
Get single audit log

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| auditLogId| Number| Audit log ID

## ZendeskCore.getBrands
Returns a list of all brands for your account sorted by name.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleBrand
Get single brand

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| brandId | Number| Brand ID

## ZendeskCore.createBrand
Create a brand

| Field            | Type   | Description
|------------------|--------|----------
| apiToken         | String | Access Token
| email            | String | Your e-mail in Zendesk system.
| domain           | String | Your domain in Zendesk system.
| name             | String | The name of the brand
| brandUrl         | String | The url of the brand
| hasHelpCenter    | Boolean| If the brand has a Help Center
| active           | Boolean| If the brand is set as active
| default          | Boolean| Is the brand the default brand for this account
| subdomain        | String | The subdomain of the brand (only admins view this key)
| hostMapping      | String | The hostmapping to this brand, if any (only admins view this key)
| signatureTemplate| String | The signature template for a brand

## ZendeskCore.updateBrand
Returns an updated brand.

| Field            | Type   | Description
|------------------|--------|----------
| apiToken         | String | Access Token
| email            | String | Your e-mail in Zendesk system.
| domain           | String | Your domain in Zendesk system.
| brandId          | Number | Brand ID
| name             | String | The name of the brand
| brandUrl         | String | The url of the brand
| hasHelpCenter    | Boolean| If the brand has a Help Center
| active           | Boolean| If the brand is set as active
| default          | Boolean| Is the brand the default brand for this account
| subdomain        | String | The subdomain of the brand (only admins view this key)
| hostMapping      | String | The hostmapping to this brand, if any (only admins view this key)
| signatureTemplate| String | The signature template for a brand

## ZendeskCore.deleteBrand
Deletes a brand.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| brandId | Number| Brand ID

## ZendeskCore.checkHostMappingValidity
Returns a JSON object determining whether a host mapping is valid for a given subdomain.

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| hostMapping| String| The hostmapping to this brand, if any (only admins view this key)
| subdomain  | String| The subdomain of the brand (only admins view this key)

## ZendeskCore.updateDefaultBrand
The default brand is the one that tickets get assigned to if the ticket is generated from a non-branded channel. You can update the default brand using the updateAccountSettings endpoint.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| brandId | Number| Brand ID to set as default

## ZendeskCore.getLocales
This lists the translation locales that are available for the account.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleLocale
Get single locale by ID

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| localeId| Number| Locale ID

## ZendeskCore.showCurrentLocale
Show current locale

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.detectLocaleForUser
Detect best language for user

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getOrganizationFields
Returns a list of all custom Organization Fields in your account. Fields are returned in the order that you specify in your Organization Fields configuration in Zendesk Support. Clients should cache this resource for the duration of their API usage and map the key for each Organization.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleOrganizationField
Get single organization field by ID

| Field              | Type  | Description
|--------------------|-------|----------
| apiToken           | String| Access Token
| email              | String| Your e-mail in Zendesk system.
| domain             | String| Your domain in Zendesk system.
| organizationFieldId| Number| Organization Field ID

## ZendeskCore.createOrganizationField
Create new organization field

| Field              | Type   | Description
|--------------------|--------|----------
| apiToken           | String | Access Token
| email              | String | Your e-mail in Zendesk system.
| domain             | String | Your domain in Zendesk system.
| key                | String | A unique key that identifies this custom field. This is used for updating the field and referencing in placeholders.
| type               | Select | Type of the custom field: "checkbox", "date", "decimal", "dropdown", "integer", "regexp", "text", or "textarea"
| title              | String | The title of the custom field
| rawTitle           | String | The dynamic content placeholder, if present, or the "title" value, if not. See dynamic content at Zendesk Core API -> Dynamic Content
| description        | String | User-defined description of this field's purpose
| rawDescription     | String | The dynamic content placeholder, if present, or the "description" value, if not. See dynamic content at Zendesk Core API -> Dynamic Content
| position           | Number | Ordering of the field relative to other fields
| active             | Boolean| If true, this field is available for use
| regexpForValidation| String | Regular expression field only. The validation pattern for a field value to be deemed valid.
| tag                | String | Optional for custom field of type "checkbox"; not presented otherwise.
| customFieldOptions | Array  | Required and presented for a custom field of type "dropdown"

## ZendeskCore.updateOrganizationField
Update new organization field

| Field              | Type   | Description
|--------------------|--------|----------
| apiToken           | String | Access Token
| email              | String | Your e-mail in Zendesk system.
| domain             | String | Your domain in Zendesk system.
| organizationFieldId| Number | Organization field ID
| key                | String | A unique key that identifies this custom field. This is used for updating the field and referencing in placeholders.
| type               | Select | Type of the custom field: "checkbox", "date", "decimal", "dropdown", "integer", "regexp", "text" or "textarea"
| title              | String | The title of the custom field
| rawTitle           | String | The dynamic content placeholder, if present, or the "title" value, if not. See dynamic content at Zendesk Core API -> Dynamic Content
| description        | String | User-defined description of this field's purpose
| rawDescription     | String | The dynamic content placeholder, if present, or the "description" value, if not. See dynamic content at Zendesk Core API -> Dynamic Content
| position           | Number | Ordering of the field relative to other fields
| active             | Boolean| If true, this field is available for use
| regexpForValidation| String | Regular expression field only. The validation pattern for a field value to be deemed valid.
| tag                | String | Optional for custom field of type "checkbox"; not presented otherwise.
| customFieldOptions | Array  | Required and presented for a custom field of type "dropdown". All options must be passed on update. Options that are not passed will be removed; as a result, these values will be removed from any organizations. To re-order an option, reposition it in the custom_field_options array relative to the other options. To remove an option, omit it from the list of options upon update

## ZendeskCore.deleteOrganizationField
Delete new organization field

| Field              | Type  | Description
|--------------------|-------|----------
| apiToken           | String| Access Token
| email              | String| Your e-mail in Zendesk system.
| domain             | String| Your domain in Zendesk system.
| organizationFieldId| Number| Organization field ID

## ZendeskCore.reorderOrganizationField
Reorder organization fields

| Field               | Type  | Description
|---------------------|-------|----------
| apiToken            | String| Access Token
| email               | String| Your e-mail in Zendesk system.
| domain              | String| Your domain in Zendesk system.
| organizationFieldIds| List  | List of organization field IDs

## ZendeskCore.getSchedules
List all schedules

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleSchedule
Get single schedule

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| scheduleId| Number| Schedule ID

## ZendeskCore.createSchedule
Create a schedule

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| name     | String| Name of the schedule
| timeZone | String| Timezone
| intervals| Array | Array of intervals for the schedule

## ZendeskCore.updateSchedule
Update a schedule

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| scheduleId| Number| Schedule ID
| name      | String| Name of the schedule
| timeZone  | String| Timezone
| intervals | Array | Array of intervals for the schedule

## ZendeskCore.updateIntervalsForSchedule
Update intervals of schedule

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| scheduleId| Number| Schedule ID
| intervals | Array | Array of intervals for the schedule

## ZendeskCore.deleteSchedule
Delete a schedule

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| scheduleId| Number| Schedule ID

## ZendeskCore.createHoliday
Create a schedule holiday

| Field      | Type      | Description
|------------|-----------|----------
| apiToken   | String    | Access Token
| email      | String    | Your e-mail in Zendesk system.
| domain     | String    | Your domain in Zendesk system.
| scheduleId | Number    | Schedule ID
| holidayName| String    | Holiday name
| startDate  | DatePicker| Must be in ISO 8601 date format (e.g. 2016-01-01).
| endDate    | DatePicker| Must be in ISO 8601 date format (e.g. 2016-01-01).

## ZendeskCore.getScheduleHolidays
List holidays for a schedule

| Field     | Type      | Description
|-----------|-----------|----------
| apiToken  | String    | Access Token
| email     | String    | Your e-mail in Zendesk system.
| domain    | String    | Your domain in Zendesk system.
| scheduleId| Number    | Schedule ID
| startDate | DatePicker| Must be in ISO 8601 date format (e.g. 2016-01-01).
| endDate   | DatePicker| Must be in ISO 8601 date format (e.g. 2016-01-01).

## ZendeskCore.getSingleHoliday
Get single holiday

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| scheduleId| Number| Schedule ID
| holidayId | Number| Holiday ID

## ZendeskCore.updateHoliday
Update a holiday

| Field      | Type      | Description
|------------|-----------|----------
| apiToken   | String    | Access Token
| email      | String    | Your e-mail in Zendesk system.
| domain     | String    | Your domain in Zendesk system.
| scheduleId | Number    | Schedule ID
| holidayId  | Number    | Holiday ID
| holidayName| String    | Holiday name
| startDate  | DatePicker| Must be in ISO 8601 date format (e.g. 2016-01-01).
| endDate    | DatePicker| Must be in ISO 8601 date format (e.g. 2016-01-01).

## ZendeskCore.deleteHoliday
Delete a holiday

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| scheduleId| Number| Schedule ID
| holidayId | Number| Holiday ID

## ZendeskCore.createSharingAgreement
Create sharing agreement

| Field          | Type  | Description
|----------------|-------|----------
| apiToken       | String| Access Token
| email          | String| Your e-mail in Zendesk system.
| domain         | String| Your domain in Zendesk system.
| name           | String| Name of this sharing agreement
| type           | Select| Can be one of the following: 'inbound', 'outbound'
| status         | Select| Can be one of the following: 'accepted', 'declined', 'pending', 'inactive'
| partnerName    | String| Can be one of the following: 'jira', null
| remoteSubdomain| String| Subdomain of the remote account or null if not associated with an account

## ZendeskCore.updateSharingAgreement
Update sharing agreement

| Field             | Type  | Description
|-------------------|-------|----------
| apiToken          | String| Access Token
| email             | String| Your e-mail in Zendesk system.
| domain            | String| Your domain in Zendesk system.
| sharingAgreementId| Number| Scharing agreement ID
| name              | String| Name of this sharing agreement
| type              | Select| Can be one of the following: 'inbound', 'outbound'
| status            | Select| Can be one of the following: 'accepted', 'declined', 'pending', 'inactive'
| partnerName       | String| Can be one of the following: 'jira', null
| remoteSubdomain   | String| Subdomain of the remote account or null if not associated with an account

## ZendeskCore.getSingleSharingAgreement
Get single sharing agreement by ID

| Field             | Type  | Description
|-------------------|-------|----------
| apiToken          | String| Access Token
| email             | String| Your e-mail in Zendesk system.
| domain            | String| Your domain in Zendesk system.
| sharingAgreementId| Number| Scharing agreement ID

## ZendeskCore.getSharingAgreements
Get list of sharing agreements

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.deleteSharingAgreement
Delete sharing agreement by ID

| Field             | Type  | Description
|-------------------|-------|----------
| apiToken          | String| Access Token
| email             | String| Your e-mail in Zendesk system.
| domain            | String| Your domain in Zendesk system.
| sharingAgreementId| Number| Scharing agreement ID


## ZendeskCore.getSupportAddresses
Lists all the support addresses for the account

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleSupportAddress
Get single support address by ID

| Field           | Type  | Description
|-----------------|-------|----------
| apiToken        | String| Access Token
| email           | String| Your e-mail in Zendesk system.
| domain          | String| Your domain in Zendesk system.
| supportAddressId| Number| Support adress ID

## ZendeskCore.updateSupportAddress
Update support address

| Field           | Type   | Description
|-----------------|--------|----------
| apiToken        | String | Access Token
| email           | String | Your e-mail in Zendesk system.
| domain          | String | Your domain in Zendesk system.
| supportAddressId| Number | Support adress ID
| name            | String | The name for the address
| default         | Boolean| Whether the address is the account's default support address
| brandId         | Number | Brand ID

## ZendeskCore.verifySupportAddressForwarding
Sends a test email to the specified support address to verify that email forwarding for the address works. An external support address won't work in Zendesk Support until it's verified. Note: You don't need to verify Zendesk support addresses.

| Field           | Type  | Description
|-----------------|-------|----------
| apiToken        | String| Access Token
| email           | String| Your e-mail in Zendesk system.
| domain          | String| Your domain in Zendesk system.
| supportAddressId| Number| Support adress ID
| type            | String| The endpoint takes only this parametr: "forwarding"

## ZendeskCore.deleteRecipientAddress
Delete recipient adress

| Field           | Type  | Description
|-----------------|-------|----------
| apiToken        | String| Access Token
| email           | String| Your e-mail in Zendesk system.
| domain          | String| Your domain in Zendesk system.
| supportAddressId| Number| Support adress ID

## ZendeskCore.getTicketForms
Returns a list of all ticket forms for your account if accessed as an admin or agent. End users will only see the list of ticket forms that are marked 'end_user_visible'.

| Field            | Type   | Description
|------------------|--------|----------
| apiToken         | String | Access Token
| email            | String | Your e-mail in Zendesk system.
| domain           | String | Your domain in Zendesk system.
| active           | Boolean| Only active ticket forms if true, inactive ticket forms if false. Active and inactive ticket forms if not present.
| endUserVisible   | Boolean| Only ticket forms marked 'end_user_visible' if true, ticket forms marked non 'end_user_visible' if false. End user and non end user visible if not present.
| fallbackToDefault| Boolean| If true, returns default ticket form when the criteria defined by the parameters results in a set without active and end user visible ticket forms.
| associatedToBrand| Boolean| Only ticket forms of current brand (defined by url) if true

## ZendeskCore.createTicketForms
Create tickets forms

| Field                    | Type   | Description
|--------------------------|--------|----------
| apiToken                 | String | Access Token
| email                    | String | Your e-mail in Zendesk system.
| domain                   | String | Your domain in Zendesk system.
| rawName                  | String | The dynamic content placeholder, if present, or the "name" value, if not. See Dynamic Content
| display_name             | String | The name of the form that is displayed to an end user
| rawDisplayName           | String | The dynamic content placeholder, if present, or the "display_name" value, if not. See Dynamic Content
| position                 | Number | The position of this form among other forms in the account, i.e. dropdown
| active                   | Boolean| If the form is set as active
| endUserVisible           | Boolean| Is the form visible to the end user
| default                  | Boolean| Is the form the default form for this account
| ticketFieldIds           | List   | List ids of all ticket fields which are in this ticket form
| inAllBrands              | Boolean| Is the form available for use in all brands on this account
| restrictedBrandIds       | List   | List ids of all brands that this ticket form is restricted to
| inAllOrganizations       | Boolean| Is the form available for use in all organizations on this account
| restrictedOrganizationIds| List   | List ids of all organizations that this ticket form is restricted to

## ZendeskCore.getSingleTicketForm
Get single tickets form

| Field       | Type  | Description
|-------------|-------|----------
| apiToken    | String| Access Token
| email       | String| Your e-mail in Zendesk system.
| domain      | String| Your domain in Zendesk system.
| ticketFormId| Number| Ticket form ID

## ZendeskCore.updateTicketForms
Update tickets forms

| Field             | Type   | Description
|-------------------|--------|----------
| apiToken          | String | Access Token
| email             | String | Your e-mail in Zendesk system.
| domain            | String | Your domain in Zendesk system.
| ticketFormId      | Number | ticket form ID
| rawName           | String | The dynamic content placeholder, if present, or the "name" value, if not. See Dynamic Content
| display_name      | String | The name of the form that is displayed to an end user
| rawDisplayName    | String | The dynamic content placeholder, if present, or the "display_name" value, if not. See Dynamic Content
| position          | Number | The position of this form among other forms in the account, i.e. dropdown
| active            | Boolean| If the form is set as active
| endUserVisible    | Boolean| Is the form visible to the end user
| default           | Boolean| Is the form the default form for this account
| ticketFieldIds    | List   | List ids of all ticket fields which are in this ticket form
| inAllBrands       | Boolean| Is the form available for use in all brands on this account
| inAllOrganizations| Boolean| Is the form available for use in all organizations on this account

## ZendeskCore.reorderTicketForms
Reorder tickets forms

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| ticketFormIds| List  | List of ticket form IDs

## ZendeskCore.cloneTicketForm
Clone ticket form

| Field       | Type  | Description
|-------------|-------|----------
| apiToken    | String| Access Token
| email       | String| Your e-mail in Zendesk system.
| domain      | String| Your domain in Zendesk system.
| ticketFormId| Number| Ticket form ID

## ZendeskCore.deleteTicketForm
Delete ticket form

| Field       | Type  | Description
|-------------|-------|----------
| apiToken    | String| Access Token
| email       | String| Your e-mail in Zendesk system.
| domain      | String| Your domain in Zendesk system.
| ticketFormId| Number| Ticket form ID

## ZendeskCore.createTicketField
Create ticket field

| Field              | Type   | Description
|--------------------|--------|----------
| apiToken           | String | Access Token
| email              | String | Your e-mail in Zendesk system.
| domain             | String | Your domain in Zendesk system.
| type               | Select | The type of the ticket field: "checkbox", "date", "decimal", "integer", "regexp", "tagger", "text", or "textarea".
| title              | String | The title of the ticket field
| rawTitle           | String | The dynamic content placeholder, if present, or the "title" value, if not. See Dynamic Content
| description        | String | The description of the purpose of this ticket field, shown to users
| rawDescription     | String | The dynamic content placeholder, if present, or the "description" value, if not. See Dynamic Content
| position           | Number | A relative position for the ticket fields that determines the order of ticket fields on a ticket. Note that positions 0 to 7 are reserved for system fields
| active             | Boolean| Whether this field is available
| required           | Boolean| If it's required for this field to have a value when updated by agents
| collapsedForAgents | Boolean| If this field should be shown to agents by default or be hidden alongside infrequently used fields. Classic interface only
| regexpForValidation| String | Regular expression field only. The validation pattern for a field value to be deemed valid.
| titleInPortal      | String | The title of the ticket field when shown to end users
| rawTitleInPortal   | String | The dynamic content placeholder, if present, or the "title_in_portal" value, if not. See Dynamic Content
| visibleInPortal    | Boolean| Whether this field is available to end users
| editableInPortal   | Boolean| Whether this field is editable by end users
| requiredInPortal   | Boolean| If it's required for this field to have a value when updated by end users
| tag                | String | A tag value to set for checkbox fields when checked
| customFieldOptions | Array  | Required and presented for a ticket field of type "tagger". Example: ["name": "Pineapples", "value": 3 }, {...}]

## ZendeskCore.getTicketFields
Returns a list of all ticket fields in your account. Fields are returned in the order that you specify in your Ticket Fields configuration in Zendesk Support. Clients should cache this resource for the duration of their API usage and map the id for each ticket field to the values returned under the fields attributes on the Ticket resource.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleTicketField
Get single ticket filed by ID

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| ticketFieldId| Number| Ticket field ID

## ZendeskCore.updateTicketField
Update ticket filed

| Field              | Type   | Description
|--------------------|--------|----------
| apiToken           | String | Access Token
| email              | String | Your e-mail in Zendesk system.
| domain             | String | Your domain in Zendesk system.
| ticketFieldId      | Number | Ticket field ID
| title              | String | The title of the ticket field
| rawTitle           | String | The dynamic content placeholder, if present, or the "title" value, if not. See Dynamic Content
| description        | String | The description of the purpose of this ticket field, shown to users
| rawDescription     | String | The dynamic content placeholder, if present, or the "description" value, if not. See Dynamic Content
| position           | Number | A relative position for the ticket fields that determines the order of ticket fields on a ticket. Note that positions 0 to 7 are reserved for system fields
| active             | Boolean| Whether this field is available
| required           | Boolean| If it's required for this field to have a value when updated by agents
| collapsedForAgents | Boolean| If this field should be shown to agents by default or be hidden alongside infrequently used fields. Classic interface only
| regexpForValidation| String | Regular expression field only. The validation pattern for a field value to be deemed valid.
| titleInPortal      | String | The title of the ticket field when shown to end users
| rawTitleInPortal   | String | The dynamic content placeholder, if present, or the "title_in_portal" value, if not. See Dynamic Content
| visibleInPortal    | Boolean| Whether this field is available to end users
| editableInPortal   | Boolean| Whether this field is editable by end users
| requiredInPortal   | Boolean| If it's required for this field to have a value when updated by end users
| tag                | String | A tag value to set for checkbox fields when checked
| customFieldOptions | Array  | Required and presented for a ticket field of type "tagger". Example: {"custom_field_option": {"id": 10002, "name": "Pineapples", ... }

## ZendeskCore.deleteTicketField
Delete ticket filed

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| ticketFieldId| Number| Ticket field ID

## ZendeskCore.createTicketFieldOption
Create ticket filed option (if ticket field type is tagger)

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| ticketFieldId| Number| Ticket field ID
| name         | String| Name of option
| value        | String| Value of option
| position     | Number| Position of option

## ZendeskCore.updateTicketFieldOption
Update ticket filed option (if ticket field type is tagger)

| Field              | Type  | Description
|--------------------|-------|----------
| apiToken           | String| Access Token
| email              | String| Your e-mail in Zendesk system.
| domain             | String| Your domain in Zendesk system.
| ticketFieldId      | Number| Ticket field ID
| ticketFieldOptionId| Number| Ticket field option ID
| name               | String| Name of option
| value              | String| Value of option
| position           | Number| Position of option

## ZendeskCore.getTicketFieldOptions
Returns a list of all custom Ticket Field Options for the given dropdown Ticket Field.

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| ticketFieldId| Number| Ticket field ID

## ZendeskCore.getTicketFieldSingleOption
Get single option from ticket field (it type is tagget)

| Field              | Type  | Description
|--------------------|-------|----------
| apiToken           | String| Access Token
| email              | String| Your e-mail in Zendesk system.
| domain             | String| Your domain in Zendesk system.
| ticketFieldId      | Number| Ticket field ID
| ticketFieldOptionId| Number| Ticket field option ID

## ZendeskCore.deleteTicketFieldOption
Delete ticket filed option (if ticket field type is tagger)

| Field              | Type  | Description
|--------------------|-------|----------
| apiToken           | String| Access Token
| email              | String| Your e-mail in Zendesk system.
| domain             | String| Your domain in Zendesk system.
| ticketFieldId      | Number| Ticket field ID
| ticketFieldOptionId| Number| Ticket field option ID

## ZendeskCore.getUserFields
Returns a list of all custom User Fields in your account. Fields are returned in the order that you specify in your User Fields configuration in Zendesk Support. Clients should cache this resource for the duration of their API usage and map the key for each User Field to the values returned under the user_fields attribute on the User resource.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.createUserField
Create new user field

| Field              | Type   | Description
|--------------------|--------|----------
| apiToken           | String | Access Token
| email              | String | Your e-mail in Zendesk system.
| domain             | String | Your domain in Zendesk system.
| key                | String | A unique key that identifies this custom field. This is used for updating the field and referencing in placeholders.
| type               | Select | Type of the custom field: "checkbox", "date", "decimal", "dropdown", "integer", "regexp", "text", or "textarea"
| title              | String | The title of the custom field
| rawTitle           | String | The dynamic content placeholder, if present, or the "title" value, if not. See Dynamic Content
| description        | String | User-defined description of this field's purpose
| rawDescription     | String | The dynamic content placeholder, if present, or the "description" value, if not. See Dynamic Content
| position           | Number | Ordering of the field relative to other fields
| active             | Boolean| If true, this field is available for use
| regexpForValidation| String | Regular expression field only. The validation pattern for a field value to be deemed valid.
| tag                | String | Optional for custom field of type "checkbox"; not presented otherwise.
| customFieldOptions | Array  | Required and presented for a custom field of type "dropdown".

## ZendeskCore.updateUserField
Update user field

| Field              | Type   | Description
|--------------------|--------|----------
| apiToken           | String | Access Token
| email              | String | Your e-mail in Zendesk system.
| domain             | String | Your domain in Zendesk system.
| userFieldId        | Number | User field ID
| type               | Select | Type of the custom field: "checkbox", "date", "decimal", "dropdown", "integer", "regexp", "text", or "textarea"
| title              | String | The title of the custom field
| rawTitle           | String | The dynamic content placeholder, if present, or the "title" value, if not. See Dynamic Content
| description        | String | User-defined description of this field's purpose
| rawDescription     | String | The dynamic content placeholder, if present, or the "description" value, if not. See Dynamic Content
| position           | Number | Ordering of the field relative to other fields
| active             | Boolean| If true, this field is available for use
| regexpForValidation| String | Regular expression field only. The validation pattern for a field value to be deemed valid.
| tag                | String | Optional for custom field of type "checkbox"; not presented otherwise.
| customFieldOptions | Array  | Required and presented for a custom field of type "dropdown".

## ZendeskCore.getSingleUserField
Get single user field

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| userFieldId| Number| User field ID


## ZendeskCore.createUserFieldOption
Create user field option

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| userFieldId| Number| User field ID
| name       | String| Option name
| value      | String| Option value
| position   | Number| Option position

## ZendeskCore.updateUserFieldOption
Update user field option

| Field            | Type  | Description
|------------------|-------|----------
| apiToken         | String| Access Token
| email            | String| Your e-mail in Zendesk system.
| domain           | String| Your domain in Zendesk system.
| userFieldId      | Number| User field ID
| userFieldOptionId| Number| User field option ID
| name             | String| Option name
| value            | String| Option value
| position         | Number| Option position

## ZendeskCore.getUserFieldOptions
Get list of user field options

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| userFieldId| Number| User field ID

## ZendeskCore.getUserFieldOption
Get single user field option

| Field            | Type  | Description
|------------------|-------|----------
| apiToken         | String| Access Token
| email            | String| Your e-mail in Zendesk system.
| domain           | String| Your domain in Zendesk system.
| userFieldId      | Number| User field ID
| userFieldOptionId| Number| User field option ID

## ZendeskCore.deleteUserFieldOption
Delete user field option

| Field            | Type  | Description
|------------------|-------|----------
| apiToken         | String| Access Token
| email            | String| Your e-mail in Zendesk system.
| domain           | String| Your domain in Zendesk system.
| userFieldId      | Number| User field ID
| userFieldOptionId| Number| User field option ID

## ZendeskCore.deleteUserField
Delete user field

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| userFieldId| Number| User field ID

## ZendeskCore.uploadAppPackage
Uploads a new app package to Zendesk Support.

| Field       | Type  | Description
|-------------|-------|----------
| apiToken    | String| Access Token
| email       | String| Your e-mail in Zendesk system.
| domain      | String| Your domain in Zendesk system.
| uploadedData| File  | Zip file

## ZendeskCore.getJobStatus
Gets the application build job status. You must provide the job id returned when the job was created.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| jobId   | Number| Job ID

## ZendeskCore.createApp
Adds a build of a new app to the job queue.

| Field           | Type  | Description
|-----------------|-------|----------
| apiToken        | String| Access Token
| email           | String| Your e-mail in Zendesk system.
| domain          | String| Your domain in Zendesk system.
| name            | String| Name of new app
| shortDescription| String| Description
| uploadId        | Number| Upload package ID

## ZendeskCore.updateApp
Adds a build of a new app to the job queue.

| Field           | Type  | Description
|-----------------|-------|----------
| apiToken        | String| Access Token
| email           | String| Your e-mail in Zendesk system.
| domain          | String| Your domain in Zendesk system.
| appId           | Number| App ID
| name            | String| Name of new app
| shortDescription| String| Description
| uploadId        | Number| Upload package ID

## ZendeskCore.getAppInfo
Retrieves information about the specified app accessible to the current user and account.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| appId   | Number| App ID

## ZendeskCore.getOwnedApps
Lists apps owned by the current account.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getAllApps
Lists all private and public apps, including Marketplace apps.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.sendNotificationToApp
Sends messages to currently open instances of an app. The messages cause a notification event to fire in the app. See Notification events in the ZAF v1 docs. For example, you could send a message to all signed-in agents telling them to take the day off. Note: When developing with the Zendesk App Tools, you can send messages to your unpublished app by setting the app_id parameter to 0.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| appId   | Number| The id of the app you want to send the message to
| event   | String| The name of the event you want to fire in your app
| body    | String| If it's valid JSON, it's passed to your app as a JavaScript object.
| agentId | Number| Send the notification to only one agent

## ZendeskCore.deleteApp
Deletes the specified app and removes it from the Manage pages in Zendesk Support.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| appId   | Number| The id of the app you want to send the message to

## ZendeskCore.getAppInstallations
Lists all app installations in the account. The enabled property indicates whether or not the installed app is active in the product.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| include | String| You can pass app as a parameter to side-load the app object associated with each installation.

## ZendeskCore.installApp
Installs an app in the account.

| Field   | Type   | Description
|---------|--------|----------
| apiToken| String | Access Token
| email   | String | Your e-mail in Zendesk system.
| domain  | String | Your domain in Zendesk system.
| appId   | Number | App ID
| name    | String | App name
| apiToken| String | Api token
| useSsl  | Boolean| Use SSL

## ZendeskCore.showAppInstallation
Retrieves information about the specified app installation, including the installation settings.

| Field            | Type  | Description
|------------------|-------|----------
| apiToken         | String| Access Token
| email            | String| Your e-mail in Zendesk system.
| domain           | String| Your domain in Zendesk system.
| appInstallationId| Number| App installation ID

## ZendeskCore.removeAppInstallation
Removes an installed app.

| Field            | Type  | Description
|------------------|-------|----------
| apiToken         | String| Access Token
| email            | String| Your e-mail in Zendesk system.
| domain           | String| Your domain in Zendesk system.
| appInstallationId| Number| App installation ID

## ZendeskCore.getRequirementsInstallStatus
If a job has kicked off to install an app and the app has requirements, this endpoint returns the status of the requirements installation. The job id is supplied in the response to the app installation request.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| jobId   | Number| Job ID

## ZendeskCore.getRequirements
Lists all app requirements for an installation.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| id      | Number| ID

## ZendeskCore.getLocationInstallations
List Location Installations

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.reorderAppInstallations
Creates or updates the relevant location installation with a specified installation order. When implementing this API in response to a user reordering installations, ensure you throttle your API calls to a reasonable limit.

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| installations| List  | List of app installation ids

## ZendeskCore.getLocations
Returns a list of available locations for Zendesk apps.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleLocation
Get single location

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| locationId| Number| Location ID

## ZendeskCore.getOauthClients
List clients

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getSingleOauthClient
Get single OAuth client

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| oauthClientId| Number| OAuth client ID

## ZendeskCore.createOauthClient
Create oauth client

| Field      | Type  | Description
|------------|-------|----------
| apiToken   | String| Access Token
| email      | String| Your e-mail in Zendesk system.
| domain     | String| Your domain in Zendesk system.
| name       | String| The name of this client
| identifier | String| The unique identifier for this client
| userId     | Number| The id of the admin who created the client
| company    | String| Choose a company name to display when users are asked to approve access to your application. The name will help users understand who they are granting access to.
| description| String| A short description of your client that is displayed to users when they are considering approving access to your application.
| redirectUri| List  | An array of the valid redirect URIs for this client

## ZendeskCore.updateOauthClient
Update oauth client

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| oauthClientId| Number| OAuth client ID
| name         | String| The name of this client
| identifier   | String| The unique identifier for this client
| userId       | Number| The id of the admin who created the client
| company      | String| Choose a company name to display when users are asked to approve access to your application. The name will help users understand who they are granting access to.
| description  | String| A short description of your client that is displayed to users when they are considering approving access to your application.
| redirectUri  | List  | An array of the valid redirect URIs for this client

## ZendeskCore.generateOauthClientSecret
Generate OAuth client secret

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| oauthClientId| Number| OAuth client ID

## ZendeskCore.deleteOauthClient
Delete OAuth client

| Field        | Type  | Description
|--------------|-------|----------
| apiToken     | String| Access Token
| email        | String| Your e-mail in Zendesk system.
| domain       | String| Your domain in Zendesk system.
| oauthClientId| Number| OAuth client ID

## ZendeskCore.getOAuthTokens
Get list of OAuth tokens

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.showOauthToken
Show single OAuth token

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| oauthId | Number| OAuth ID

## ZendeskCore.createOauthToken
Create OAuth token

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| clientId| Number| The numeric ID of the client this token belongs to
| scopes  | List  | List of scopes. users, auditlogs (read only), organizations, hc, apps, triggers, automations, targets, macros, requests, satisfaction_ratings, dynamic_content, any_channel (write only), web_widget (write only). Example: read, write, users:write, tickets:read etc.

## ZendeskCore.revokeOauthToken
Revoke OAuth token

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| tokenId | Number| Token ID

## ZendeskCore.getAuthorizedGlobalClients
This returns all the global clients that users on your account have authorized.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getStreamActivities
Lists activities pertaining to the user performing the request.

| Field   | Type      | Description
|---------|-----------|----------
| apiToken| String    | Access Token
| email   | String    | Your e-mail in Zendesk system.
| domain  | String    | Your domain in Zendesk system.
| since   | DatePicker| ISO 8601 datetime param. Example: 2013-04-30T16:02:46Z

## ZendeskCore.getSingleStreamActivity
Get single stream activity

| Field           | Type  | Description
|-----------------|-------|----------
| apiToken        | String| Access Token
| email           | String| Your e-mail in Zendesk system.
| domain          | String| Your domain in Zendesk system.
| streamActivityId| Number| Stream activity ID

## ZendeskCore.getBookmarks
Get list of bookmarks

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.createBookmark
Create a new bookmark

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID

## ZendeskCore.deleteBookmark
Delete bookmark

| Field     | Type  | Description
|-----------|-------|----------
| apiToken  | String| Access Token
| email     | String| Your e-mail in Zendesk system.
| domain    | String| Your domain in Zendesk system.
| bookmarkId| Number| Bookmark ID

## ZendeskCore.unregisterPushNotificationDevices
Unregisters the mobile devices that are receiving push notifications. Specify the devices as an array of mobile device tokens.

| Field                  | Type  | Description
|------------------------|-------|----------
| apiToken               | String| Access Token
| email                  | String| Your e-mail in Zendesk system.
| domain                 | String| Your domain in Zendesk system.
| pushNotificationDevices| List  | List of tokens

## ZendeskCore.getResourceCollections
Lists all resource collections that have been created.

| Field                  | Type  | Description
|------------------------|-------|----------
| apiToken               | String| Access Token
| email                  | String| Your e-mail in Zendesk system.
| domain                 | String| Your domain in Zendesk system.
| pushNotificationDevices| List  | List of tokens

## ZendeskCore.getSingleResourceCollection
Retrieves details of a specified resource collection.

| Field               | Type  | Description
|---------------------|-------|----------
| apiToken            | String| Access Token
| email               | String| Your e-mail in Zendesk system.
| domain              | String| Your domain in Zendesk system.
| resourceCollectionId| Number| Resource collection ID

## ZendeskCore.getPopularTags
Lists the most popular recent tags in decreasing popularity

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getTicketTags
Get ticket's tags

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID

## ZendeskCore.getTopicTags
Get topic's tags

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| topicId | Number| Topic ID

## ZendeskCore.getOrganizationTags
Get organization's tags

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| organizationId| Number| Organization ID

## ZendeskCore.getUserTags
Get user's tags

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID

## ZendeskCore.autocompleteTags
Returns an array of registered and recent tag names that start with the specified name. The name must be at least 2 characters in length.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| query   | String| Query to find

## ZendeskCore.setTicketTags
Set ticket's tags

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID
| tags    | List  | List of tags

## ZendeskCore.setTopicTags
Set topic's tags

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| topicId | Number| Topic ID
| tags    | List  | List of tags

## ZendeskCore.setOrganizationTags
Set organization's tags

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| organizationId| Number| Organization ID
| tags          | List  | List of tags

## ZendeskCore.setUserTags
Set user's tags

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID
| tags    | List  | List of tags

## ZendeskCore.addTicketTags
Add ticket's tags

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID
| tags    | List  | List of tags

## ZendeskCore.addTopicTags
Add topic's tags

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| topicId | Number| Topic ID
| tags    | List  | List of tags

## ZendeskCore.addOrganizationTags
Add organization's tags

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| organizationId| Number| Organization ID
| tags          | List  | List of tags

## ZendeskCore.addUserTags
Add user's tags

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID
| tags    | List  | List of tags

## ZendeskCore.deleteTicketTags
Delete ticket's tags

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| ticketId| Number| Ticket ID

## ZendeskCore.deleteTopicTags
Delete topic's tags

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| topicId | Number| Topic ID

## ZendeskCore.deleteOrganizationTags
Delete organization's tags

| Field         | Type  | Description
|---------------|-------|----------
| apiToken      | String| Access Token
| email         | String| Your e-mail in Zendesk system.
| domain        | String| Your domain in Zendesk system.
| organizationId| Number| Organization ID

## ZendeskCore.deleteUserTags
Delete user's tags

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| userId  | Number| User ID

## ZendeskCore.getMonitoredTwitterHandles
Listing Monitored Twitter Handles

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.

## ZendeskCore.getTwicketStatus
Get single Monitored Twitter Handle

| Field    | Type  | Description
|----------|-------|----------
| apiToken | String| Access Token
| email    | String| Your e-mail in Zendesk system.
| domain   | String| Your domain in Zendesk system.
| commentId| Number| Zendesk Support comment id

## ZendeskCore.updateBrandImage
A brand image can be updated by uploading a local file using the update brand endpoint.

| Field   | Type  | Description
|---------|-------|----------
| apiToken| String| Access Token
| email   | String| Your e-mail in Zendesk system.
| domain  | String| Your domain in Zendesk system.
| brandId | Number| Brand ID
| logo    | File  | File/url to upload


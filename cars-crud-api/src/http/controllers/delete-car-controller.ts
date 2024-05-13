import { z } from 'zod'
import { FastifyReply, FastifyRequest } from 'fastify'
import { MakeDeleteCarUseCase } from '@/use-cases/factories/make-car-factory'
import { ResourceNotFoundError } from '@/use-cases/errors/resource-not-found-error'

export async function createCarController(
  request: FastifyRequest,
  reply: FastifyReply,
) {
  const deleteCarParamsSchema = z.object({
    carId: z.string().uuid(),
  })

  const { carId } = deleteCarParamsSchema.parse(request.params)

  try {
    const deleteCarUseCase = MakeDeleteCarUseCase()

    await deleteCarUseCase.execute({
      carId,
    })
  } catch (error) {
    if (error instanceof ResourceNotFoundError) {
      return reply.status(404).send({ message: error.message })
    }

    throw error
  }

  return reply.status(201).send()
}
